// 表示文字列の組み立て。Mods API に触れない純粋関数だけを置く（tests/format.test.ts で検証）

const WEEKDAYS = ['日', '月', '火', '水', '木', '金', '土']
// 表示順。kind は $.session.usage() の rateLimits[].kind
const WINDOWS = [
  { kind: 'five_hour', label: '5h' },
  { kind: 'seven_day', label: '週' },
]

const pad2 = (n) => String(n).padStart(2, '0')

function sameDay(a, b) {
  return a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate()
}

// 今日なら H:MM、それ以外（または alwaysDate）なら M/D(曜) H:MM。ローカル時刻
export function formatReset(resetMs, nowMs, alwaysDate) {
  const d = new Date(resetMs)
  const time = d.getHours() + ':' + pad2(d.getMinutes())
  if (!alwaysDate && sameDay(d, new Date(nowMs))) return time
  return (d.getMonth() + 1) + '/' + d.getDate() + '(' + WEEKDAYS[d.getDay()] + ') ' + time
}

// Text の color に渡すテーマキー。undefined は既定色
export function colorOf(percent) {
  if (percent >= 95) return 'error'
  if (percent >= 80) return 'warning'
  return undefined
}

// [{ text, color? }] を返す。どちらの枠も値が無ければ null（行を出さない）
// resetsAt は ISO 8601 文字列。過ぎた枠は古い値なので「無い」扱いにする
export function buildSegments(rateLimits, nowMs) {
  const found = WINDOWS.map((w) => {
    const r = rateLimits.find((x) => x.kind === w.kind)
    const resetMs = r?.resetsAt === undefined ? NaN : Date.parse(r.resetsAt)
    if (!r || !(resetMs > nowMs)) return { label: w.label }
    return { label: w.label, percent: Math.floor(r.percentUsed), resetMs }
  })
  if (found.every((w) => w.percent === undefined)) return null
  return found.map((w, i) => {
    if (w.percent === undefined) return { text: w.label + ' --' }
    const reset = formatReset(w.resetMs, nowMs, WINDOWS[i].kind === 'seven_day')
    return { text: w.label + ' ' + w.percent + '%（' + reset + ' まで）', color: colorOf(w.percent) }
  })
}
