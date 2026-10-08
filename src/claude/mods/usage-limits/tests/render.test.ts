import { expect, mock, test } from 'claude-code/testing'

const at = (mo: number, d: number, h: number) => new Date(2026, mo - 1, d, h).getTime()
const BASE = { plugin: 'usage-limits', viewport: { columns: 120, rows: 40 } } as const
// Claude Code が ui.render に渡すもの。terminal はヒント行、desktop はプロンプト上の帯に描く
const HINT = {
  ...BASE,
  component: 'PromptHint',
  requestId: 'hint',
  props: { isDraft: false, isWorking: false, hint: '? for shortcuts' },
} as const
const BAND = {
  ...BASE,
  component: 'AbovePrompt',
  requestId: 'band',
  props: { hasSurvey: false, isWorking: false, maxRows: 10, bodyColumns: 115, scroll: { offset: 0, bodyRows: 9 }, view: {} },
} as const
const BOTH = [
  { kind: 'five_hour', percentUsed: 96, resetsAt: new Date(at(10, 8, 14)).toISOString() },
  { kind: 'seven_day', percentUsed: 81, resetsAt: new Date(at(10, 13, 9)).toISOString() },
]

test('描画: terminal はヒント行の右', async ($, on) => {
  mock.clock(on, { now: at(10, 8, 9) })
  on('session.usage', () => ({ value: { context: {}, rateLimits: BOTH } }))
  // エンジンの描画の代わり
  on('ui.render', () => ({ type: 'Text', props: {}, children: ['ENGINE'] }))
  const ui = await $.ui.mount({ ...HINT, surface: 'terminal' })
  expect(await ui.find({ type: 'Text', text: 'ENGINE' })).toBeDefined()
  expect((await ui.find({ type: 'Text', text: /5h 96%/ }))?.props.color).toBe('error')
  expect((await ui.find({ type: 'Text', text: /週 81%/ }))?.props.color).toBe('warning')
  await ui.unmount()
})

test('描画: desktop はプロンプト上の帯', async ($, on) => {
  mock.clock(on, { now: at(10, 8, 9) })
  on('session.usage', () => ({ value: { context: {}, rateLimits: BOTH } }))
  on('ui.render', () => ({ type: 'Text', props: {}, children: ['ENGINE'] }))
  const ui = await $.ui.mount({ ...BAND, surface: 'desktop' })
  expect((await ui.find({ type: 'Text', text: /5h 96%/ }))?.props.color).toBe('error')
  expect((await ui.find({ type: 'Text', text: /週 81%/ }))?.props.color).toBe('warning')
  await ui.unmount()
})

test('もう一方の surface では描かない', async ($, on) => {
  mock.clock(on, { now: at(10, 8, 9) })
  on('session.usage', () => ({ value: { context: {}, rateLimits: BOTH } }))
  on('ui.render', () => ({ type: 'Text', props: {}, children: ['ENGINE'] }))
  for (const site of [{ ...HINT, surface: 'desktop' }, { ...BAND, surface: 'terminal' }] as const) {
    const ui = await $.ui.mount(site)
    expect(await ui.find({ type: 'Text', text: /5h/ })).toBeUndefined()
    await ui.unmount()
  }
})

test('アンケート表示中は帯を譲る', async ($, on) => {
  mock.clock(on, { now: at(10, 8, 9) })
  on('session.usage', () => ({ value: { context: {}, rateLimits: BOTH } }))
  on('ui.render', () => ({ type: 'Text', props: {}, children: ['ENGINE'] }))
  const ui = await $.ui.mount({ ...BAND, surface: 'desktop', props: { ...BAND.props, hasSurvey: true } })
  expect(await ui.find({ type: 'Text', text: 'ENGINE' })).toBeDefined()
  expect(await ui.find({ type: 'Text', text: /5h/ })).toBeUndefined()
})

test('値が無ければエンジンの行だけ', async ($, on) => {
  mock.clock(on, { now: at(10, 8, 9) })
  on('session.usage', () => ({ value: { context: {}, rateLimits: [] } }))
  on('ui.render', () => ({ type: 'Text', props: {}, children: ['ENGINE'] }))
  const ui = await $.ui.mount({ ...HINT, surface: 'terminal' })
  expect(await ui.find({ type: 'Text', text: 'ENGINE' })).toBeDefined()
  expect(await ui.find({ type: 'Text', text: /5h/ })).toBeUndefined()
})

test('片方が欠けたら -- を既定色で描き、区切りを付ける', async ($, on) => {
  mock.clock(on, { now: at(10, 8, 9) })
  on('session.usage', () => ({ value: { context: {}, rateLimits: [
    { kind: 'five_hour', percentUsed: 85, resetsAt: new Date(at(10, 8, 14)).toISOString() },
  ] } }))
  on('ui.render', () => ({ type: 'Text', props: {}, children: ['ENGINE'] }))
  const ui = await $.ui.mount({ ...BAND, surface: 'desktop' })
  expect((await ui.find({ type: 'Text', text: /^5h 85%/ }))?.props.color).toBe('warning')
  const week = await ui.find({ type: 'Text', text: '· 週 --' })
  expect(week).toBeDefined()
  expect(week?.props.color).toBeUndefined()
})
