import { buildSegments } from './format.js'

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

  // プロンプト下のヒント行。エンジンの行（? for shortcuts など）を残し、右に並べる
  on('ui.render', { component: 'PromptHint' }, async ($, e, next) => {
    const usage = await $.session.usage()
    const segments = buildSegments(usage.rateLimits, await $.clock.now())
    if (segments === null) return next(e)
    const { Box, Text } = $.ui.resolve(e)
    const theirs = await next(e)
    const ours = segments.map((s, i) =>
      Text(s.color === undefined ? { children: [(i ? '· ' : '') + s.text] } : { color: s.color, children: [(i ? '· ' : '') + s.text] }))
    return Box({ flexDirection: 'row', columnGap: 2, children: [theirs, Box({ flexDirection: 'row', columnGap: 1, children: ours })] })
  })
}
