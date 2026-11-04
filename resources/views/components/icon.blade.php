@props(['name', 'size' => 24])

<svg xmlns="http://www.w3.org/2000/svg" width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false" {{ $attributes }}>
    @switch($name)
        @case('timer')
            <circle cx="12" cy="13" r="8" />
            <path d="M9 2h6" />
            <path d="M12 2v3" />
            <path d="M12 13V8" />
            <path d="M12 13l3 2" />
            @break

        @case('clock')
            <circle cx="12" cy="12" r="9" />
            <path d="M12 7v5l3 2" />
            @break

        @case('list')
            <path d="M8 6h13" />
            <path d="M8 12h13" />
            <path d="M8 18h13" />
            <path d="M3 6h.01" />
            <path d="M3 12h.01" />
            <path d="M3 18h.01" />
            @break

        @case('check')
            <path d="M20 6L9 17l-5-5" />
            @break

        @case('chart')
            <path d="M4 19V5" />
            <path d="M4 19h16" />
            <path d="M8 16v-4" />
            <path d="M12 16V8" />
            <path d="M16 16v-7" />
            @break

        @case('tag')
            <path d="M20.6 13.4l-7.2 7.2a2 2 0 0 1-2.8 0l-6.2-6.2a2 2 0 0 1-.6-1.4V4a1 1 0 0 1 1-1h9a2 2 0 0 1 1.4.6l6.2 6.2a2 2 0 0 1 0 2.8z" />
            <circle cx="7.5" cy="7.5" r="1" />
            @break

        @case('target')
            <circle cx="12" cy="12" r="9" />
            <circle cx="12" cy="12" r="5" />
            <circle cx="12" cy="12" r="1" />
            @break

        @case('coffee')
            <path d="M4 8h12v6a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V8z" />
            <path d="M16 9h2a3 3 0 0 1 0 6h-2" />
            <path d="M7 3v2" />
            <path d="M11 3v2" />
            <path d="M15 3v2" />
            @break

        @case('shield')
            <path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3z" />
            @break

        @case('calendar')
            <rect x="3" y="5" width="18" height="16" rx="2" />
            <path d="M16 3v4" />
            <path d="M8 3v4" />
            <path d="M3 11h18" />
            @break

        @case('user')
            <circle cx="12" cy="8" r="4" />
            <path d="M4 21a8 8 0 0 1 16 0" />
            @break

        @case('logout')
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <path d="M16 17l5-5-5-5" />
            <path d="M21 12H9" />
            @break

        @case('arrow-left')
            <path d="M19 12H5" />
            <path d="M12 19l-7-7 7-7" />
            @break

        @default
            <circle cx="12" cy="12" r="9" />
            <path d="M12 8v4l3 2" />
    @endswitch
</svg>
