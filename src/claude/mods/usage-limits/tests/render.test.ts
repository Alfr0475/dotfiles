import { expect, mock, test } from 'claude-code/testing'

const at = (mo: number, d: number, h: number) => new Date(2026, mo - 1, d, h).getTime()
// Claude Code が PromptHint の ui.render に渡すもの（surface 以外）
const HINT = {
  plugin: 'usage-limits',
  component: 'PromptHint',
  requestId: 'hint',
  viewport: { columns: 120, rows: 40 },
  props: { isDraft: false, isWorking: false, hint: '? for shortcuts' },
} as const

for (const surface of ['terminal', 'desktop'] as const) {
  test('描画: ' + surface, async ($, on) => {
    mock.clock(on, { now: at(10, 8, 9) })
    on('session.usage', () => ({ value: { context: {}, rateLimits: [
      { kind: 'five_hour', percentUsed: 96, resetsAt: new Date(at(10, 8, 14)).toISOString() },
      { kind: 'seven_day', percentUsed: 81, resetsAt: new Date(at(10, 13, 9)).toISOString() },
    ] } }))
    // エンジンの描画の代わり
    on('ui.render', () => ({ type: 'Text', props: {}, children: ['ENGINE'] }))
    const ui = await $.ui.mount({ ...HINT, surface })
    expect(await ui.find({ type: 'Text', text: 'ENGINE' })).toBeDefined()
    const five = await ui.find({ type: 'Text', text: /5h 96%/ })
    expect(five?.props.color).toBe('error')
    const week = await ui.find({ type: 'Text', text: /週 81%/ })
    expect(week?.props.color).toBe('warning')
    await ui.unmount()
  })
}

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
  const ui = await $.ui.mount({ ...HINT, surface: 'desktop' })
  expect((await ui.find({ type: 'Text', text: /^5h 85%/ }))?.props.color).toBe('warning')
  const week = await ui.find({ type: 'Text', text: '· 週 --' })
  expect(week).toBeDefined()
  expect(week?.props.color).toBeUndefined()
})
