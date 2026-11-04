<svg viewBox="0 0 800 1000" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" {{ $attributes }}>
    <defs>
        <linearGradient id="focus-scene-sky" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#0b0e14" />
            <stop offset="58%" stop-color="#2b3fc0" />
            <stop offset="100%" stop-color="#5a1810" />
        </linearGradient>
        <linearGradient id="focus-scene-lake" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2b3fc0" stop-opacity="0.7" />
            <stop offset="45%" stop-color="#1b2232" stop-opacity="0.9" />
            <stop offset="100%" stop-color="#0b0e14" />
        </linearGradient>
        <linearGradient id="focus-scene-reflection" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#ffd500" stop-opacity="0.55" />
            <stop offset="100%" stop-color="#ffd500" stop-opacity="0" />
        </linearGradient>
    </defs>

    <rect width="800" height="1000" fill="url(#focus-scene-sky)" />

    <g fill="#e8ecf5">
        <circle cx="70" cy="90" r="1.6" opacity="0.8" />
        <circle cx="140" cy="160" r="1.2" opacity="0.55" />
        <circle cx="220" cy="70" r="1.8" opacity="0.9" />
        <circle cx="300" cy="130" r="1.1" opacity="0.4" />
        <circle cx="380" cy="55" r="1.5" opacity="0.75" />
        <circle cx="470" cy="105" r="1.3" opacity="0.6" />
        <circle cx="550" cy="45" r="1.8" opacity="0.85" />
        <circle cx="640" cy="120" r="1.2" opacity="0.5" />
        <circle cx="720" cy="75" r="1.6" opacity="0.7" />
        <circle cx="110" cy="260" r="1.1" opacity="0.45" />
        <circle cx="190" cy="330" r="1.4" opacity="0.65" />
        <circle cx="270" cy="230" r="1.2" opacity="0.5" />
        <circle cx="350" cy="310" r="1.7" opacity="0.8" />
        <circle cx="430" cy="210" r="1.1" opacity="0.4" />
        <circle cx="520" cy="300" r="1.5" opacity="0.75" />
        <circle cx="610" cy="220" r="1.2" opacity="0.55" />
        <circle cx="690" cy="320" r="1.8" opacity="0.9" />
        <circle cx="760" cy="240" r="1.1" opacity="0.45" />
        <circle cx="60" cy="420" r="1.2" opacity="0.5" />
        <circle cx="160" cy="470" r="1.5" opacity="0.65" />
        <circle cx="250" cy="410" r="1.1" opacity="0.4" />
        <circle cx="340" cy="460" r="1.3" opacity="0.55" />
        <circle cx="450" cy="430" r="1.6" opacity="0.7" />
        <circle cx="560" cy="470" r="1.2" opacity="0.5" />
        <circle cx="670" cy="410" r="1.4" opacity="0.6" />
        <circle cx="750" cy="460" r="1.1" opacity="0.45" />
    </g>

    <g>
        <circle cx="400" cy="610" r="92" fill="#ffd500" />
        <circle cx="400" cy="610" r="128" fill="none" stroke="#ffd500" stroke-width="6" stroke-linecap="round" stroke-dasharray="190 614" transform="rotate(-90 400 610)" opacity="0.75" />
        <rect x="388" y="492" width="24" height="12" rx="6" fill="#ffd500" />
    </g>

    <g>
        <polygon points="0,650 120,520 240,610 360,470 500,620 640,500 800,640 800,790 0,790" fill="#2b3fc0" opacity="0.55" />
        <polygon points="0,700 150,590 280,680 420,560 560,690 700,580 800,700 800,830 0,830" fill="#1b2232" opacity="0.92" />
        <polygon points="0,760 130,690 260,750 400,660 540,760 680,680 800,760 800,900 0,900" fill="#0b0e14" />
    </g>

    <rect x="0" y="690" width="800" height="310" fill="url(#focus-scene-lake)" />
    <rect x="356" y="690" width="88" height="310" fill="url(#focus-scene-reflection)" />

    <g stroke="#ffd500" stroke-width="2" opacity="0.22">
        <line x1="80" y1="735" x2="300" y2="735" />
        <line x1="470" y1="760" x2="720" y2="760" />
        <line x1="120" y1="800" x2="360" y2="800" />
        <line x1="430" y1="830" x2="690" y2="830" />
        <line x1="60" y1="870" x2="250" y2="870" />
        <line x1="500" y1="900" x2="760" y2="900" />
        <line x1="180" y1="940" x2="420" y2="940" />
    </g>

    <g fill="#0b0e14">
        <path d="M92 690l-28 76h20l-34 78h24l-38 84h112l-38-84h24l-34-78h20z" />
        <path d="M170 760l-22 60h16l-27 62h19l-30 68h88l-30-68h19l-27-62h16z" />
        <path d="M700 710l-30 82h22l-37 84h26l-41 90h120l-41-90h26l-37-84h22z" />
        <path d="M770 770l-24 66h18l-30 68h21l-33 74h96l-33-74h21l-30-68h18z" />
        <path d="M600 810l-20 54h15l-25 56h18l-28 62h80l-28-62h18l-25-56h15z" />
        <path d="M36 780l-18 50h14l-23 52h16l-26 58h74l-26-58h16l-23-52h14z" />
    </g>
</svg>
