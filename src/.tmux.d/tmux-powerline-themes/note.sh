# NotePC用テーマ

if patched_font_in_use; then
    TMUX_POWERLINE_SEPARATOR_LEFT_BOLD="⮂"
    TMUX_POWERLINE_SEPARATOR_LEFT_THIN="⮃"
    TMUX_POWERLINE_SEPARATOR_RIGHT_BOLD="⮀"
    TMUX_POWERLINE_SEPARATOR_RIGHT_THIN="⮁"
else
    TMUX_POWERLINE_SEPARATOR_LEFT_BOLD="◀"
    TMUX_POWERLINE_SEPARATOR_LEFT_THIN="❮"
    TMUX_POWERLINE_SEPARATOR_RIGHT_BOLD="▶"
    TMUX_POWERLINE_SEPARATOR_RIGHT_THIN="❯"
fi

TMUX_POWERLINE_DEFAULT_BACKGROUND_COLOR=${TMUX_POWERLINE_DEFAULT_BACKGROUND_COLOR:-'235'}
TMUX_POWERLINE_DEFAULT_FOREGROUND_COLOR=${TMUX_POWERLINE_DEFAULT_FOREGROUND_COLOR:-'255'}

TMUX_POWERLINE_DEFAULT_LEFTSIDE_SEPARATOR=${TMUX_POWERLINE_DEFAULT_LEFTSIDE_SEPARATOR:-$TMUX_POWERLINE_SEPARATOR_RIGHT_BOLD}
TMUX_POWERLINE_DEFAULT_RIGHTSIDE_SEPARATOR=${TMUX_POWERLINE_DEFAULT_RIGHTSIDE_SEPARATOR:-$TMUX_POWERLINE_SEPARATOR_LEFT_BOLD}


# Format: segment_name background_color foreground_color [non_default_separator]

if [ -z $TMUX_POWERLINE_LEFT_STATUS_SEGMENTS ]; then
    TMUX_POWERLINE_LEFT_STATUS_SEGMENTS=(
        "tmux_session_info 148 234" \ # セッション
        "hostname 33 0" \             # ホスト名
        "ifstat 30 255" \             # ネットワーク利用率
        #"ifstat_sys 30 255" \         # ネットワークシステム
        "lan_ip 24 255 ${TMUX_POWERLINE_SEPARATOR_RIGHT_THIN}" \ # LAN IPアドレス
        "wan_ip 24 255" \                                        # WAN IPアドレス
        #"vcs_branch 29 88" \
        #"vcs_compare 60 255" \
        #"vcs_staged 64 255" \
        #"vcs_modified 9 255" \
        #"vcs_others 245 0" \
    )
fi

if [ -z $TMUX_POWERLINE_RIGHT_STATUS_SEGMENTS ]; then
    TMUX_POWERLINE_RIGHT_STATUS_SEGMENTS=(
        #"earthquake 3 0" \      # 地震速報
        #"pwd 89 211" \          # 現在のディレクトリ
        #"mailcount 9 255" \     # メール
        #"now_playing 234 37" \  # 再生曲
        #"cpu 240 136" \         # CPU
        #"load 237 167" \        # ロードアベレージ
        "tmux_mem_cpu_load 234 136" \ # メモリ
        "battery 137 127" \     # バッテリー
        #"weather 37 255" \      # 天気
        #"rainbarf 0 0" \        # 降水確率
        #"xkb_layout 125 117" \  # XKBのレイアウト
        "date_day 235 136" \    # 曜日
        "date 235 136 ${TMUX_POWERLINE_SEPARATOR_LEFT_THIN}" \ # 日付
        "time 235 136 ${TMUX_POWERLINE_SEPARATOR_LEFT_THIN}" \ # 時刻
        #"utc_time 235 136 ${TMUX_POWERLINE_SEPARATOR_LEFT_THIN}" \ 起動時間
    )
fi
