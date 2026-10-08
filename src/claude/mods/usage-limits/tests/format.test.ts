import { expect, test } from 'claude-code/testing'
import { buildSegments, colorOf, formatReset } from '../hooks/format.js'

// ローカル時刻で組み立てる（実行環境のタイムゾーンに依存させない）
const at = (mo: number, d: number, h: number, mi = 0) => new Date(2026, mo - 1, d, h, mi).getTime()
const iso = (ms: number) => new Date(ms).toISOString()
const NOW = at(10, 8, 9, 30) // 2026-10-08(木) 9:30

test('両方の枠がある', () => {
  const s = buildSegments([
    { kind: 'five_hour', percentUsed: 42.7, resetsAt: iso(at(10, 8, 14)) },
    { kind: 'seven_day', percentUsed: 63, resetsAt: iso(at(10, 13, 9)) },
  ], NOW)
  expect(s).toEqual([
    { text: '5h 42%（14:00 まで）', color: undefined },
    { text: '週 63%（10/13(火) 9:00 まで）', color: undefined },
  ])
})

test('5h のリセットが翌日なら日付を付ける', () => {
  expect(formatReset(at(10, 9, 1, 5), at(10, 8, 22), false)).toBe('10/9(金) 1:05')
})

test('片方だけ・期限切れは --、両方無ければ null', () => {
  expect(buildSegments([{ kind: 'seven_day', percentUsed: 19, resetsAt: iso(at(10, 11, 23)) }], NOW))
    .toEqual([{ text: '5h --' }, { text: '週 19%（10/11(日) 23:00 まで）', color: undefined }])
  expect(buildSegments([{ kind: 'five_hour', percentUsed: 50, resetsAt: iso(at(10, 8, 9)) }], NOW)).toBe(null)
  expect(buildSegments([{ kind: 'five_hour', percentUsed: 30, resetsAt: iso(at(10, 8, 14)) }], NOW))
    .toEqual([{ text: '5h 30%（14:00 まで）', color: undefined }, { text: '週 --' }])
  expect(buildSegments([
    { kind: 'five_hour', percentUsed: 30 },
    { kind: 'seven_day', percentUsed: 19, resetsAt: iso(at(10, 11, 23)) },
  ], NOW)).toEqual([{ text: '5h --' }, { text: '週 19%（10/11(日) 23:00 まで）', color: undefined }])
  expect(buildSegments([], NOW)).toBe(null)
  expect(buildSegments([{ kind: 'spend_limit', percentUsed: 10 }], NOW)).toBe(null)
})

test('色の閾値', () => {
  expect(colorOf(79.9)).toBeUndefined()
  expect(colorOf(80)).toBe('warning')
  expect(colorOf(94)).toBe('warning')
  expect(colorOf(95)).toBe('error')
  expect(colorOf(120)).toBe('error')
})
