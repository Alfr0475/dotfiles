import { buildSegments } from './format.js'

// 表示する Text の列。どちらの枠も値が無ければ null
async function usageTexts($, Text) {
  const usage = await $.session.usage()
  const segments = buildSegments(usage.rateLimits, await $.clock.now())
  if (segments === null) return null
  return segments.map((s, i) =>
    Text(s.color === undefined ? { children: [(i ? '· ' : '') + s.text] } : { color: s.color, children: [(i ? '· ' : '') + s.text] }))
}

export function register(on) {
  // ui.render はタイマーでは再実行されないので、リセット時刻の経過を拾うために 1 分ごとに描き直す
  on('session.start', async ($, e, next) => {
    $.clock.every(60_000, () => $.ui.invalidate('ui.render'))
    return next(e)
  })

  // 各ターンの後と、使用率が 1 ポイント動いたときに届く
  on('session.measure', async ($, e, next) => {
    if (e.changed.includes('rateLimits')) $.ui.invalidate('ui.render')
    return next(e)
  })

  // terminal: プロンプト下のヒント行。エンジンの行（? for shortcuts など）を残し、右に並べる
  on('ui.render', { component: 'PromptHint' }, async ($, e, next) => {
    if (e.surface !== 'terminal') return next(e)
    const { Box, Text } = $.ui.resolve(e)
    const ours = await usageTexts($, Text)
    if (ours === null) return next(e)
    const theirs = await next(e)
    return Box({ flexDirection: 'row', columnGap: 2, children: [theirs, Box({ flexDirection: 'row', columnGap: 1, children: ours })] })
  })

  // desktop: PromptHint が呼ばれない（2.1.293 で実測）ので、プロンプト上の帯に出す。アンケート表示中は譲る
  on('ui.render', { component: 'AbovePrompt' }, async ($, e, next) => {
    if (e.surface !== 'desktop' || e.props.hasSurvey) return next(e)
    const { Box, Text } = $.ui.resolve(e)
    const ours = await usageTexts($, Text)
    if (ours === null) return next(e)
    return Box({ flexDirection: 'row', columnGap: 1, children: ours })
  })
}
