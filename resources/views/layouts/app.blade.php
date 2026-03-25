<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', __('cv.title'))</title>
    <meta name="description" content="@yield('description', __('cv.description'))">

    {{-- Tailwind CDN (v2 – same as original) --}}
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- AOS animations --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Notyf toast (optional, kept for parity) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <link rel="shortcut icon" href="{{ asset('images/curriculum.png') }}" type="image/png">

    <style>
        /* ── Brand colours ─────────────────────────────────────── */
        :root {
            --blue: #21254a;
            --grey: #e6e7eb;
        }
        .bg-brand-blue  { background-color: var(--blue); }
        .text-brand-blue { color: var(--blue); }
        .bg-brand-grey  { background-color: var(--grey); }

        /* ── Utility ────────────────────────────────────────────── */
        body { background: #f3f4f6; font-family: 'Helvetica Neue', Arial, sans-serif; }

        /* ── Language flag buttons ──────────────────────────────── */
        .lang-bar {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 50;
            display: flex;
            gap: .5rem;
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(6px);
            border-radius: 999px;
            padding: .35rem .6rem;
            box-shadow: 0 2px 8px rgba(0,0,0,.15);
        }
        .lang-btn {
            display: flex;
            align-items: center;
            gap: .3rem;
            padding: .25rem .6rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--blue);
            text-decoration: none;
            transition: background .15s;
        }
        .lang-btn:hover       { background: #e0e2ef; }
        .lang-btn.active      { background: var(--blue); color: #fff; }
        .lang-btn .flag       { font-size: 1.1rem; line-height: 1; }

        /* ── Download bar ───────────────────────────────────────── */
        .dl-bar {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 50;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }
        .dl-btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: .5rem;
            padding: .5rem .9rem;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0,0,0,.25);
            transition: opacity .15s;
        }
        .dl-btn:hover { opacity: .85; }
        .dl-btn i     { width: 14px; text-align: center; }

        /* ── Print / PDF clean view ─────────────────────────────── */
        @media print {
            .lang-bar, .dl-bar { display: none !important; }
            body { background: #fff; }
            .shadow-2xl { box-shadow: none !important; }
        }
    </style>
</head>
<body>

    {{-- ── Language switcher ─────────────────────────────────────── --}}
    <div class="lang-bar" aria-label="Language switcher">
        <a href="{{ route('lang.switch', 'nl') }}"
           class="lang-btn {{ app()->getLocale() === 'nl' ? 'active' : '' }}"
           title="Nederlands">
            <span class="flag">🇳🇱</span> NL
        </a>
        <a href="{{ route('lang.switch', 'en') }}"
           class="lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}"
           title="English">
            <span class="flag">🇬🇧</span> EN
        </a>
    </div>

    {{-- ── Download bar ───────────────────────────────────────────── --}}
    <div class="dl-bar">
        {{-- PNG is client-side --}}
        <button class="dl-btn" id="btn-png" onclick="downloadPng()">
            <i class="fa-regular fa-image"></i> {{ __('cv.download_png') }}
        </button>
        <a class="dl-btn" href="{{ route('download.pdf') }}" target="_blank">
            <i class="fa-regular fa-file-pdf"></i> {{ __('cv.download_pdf') }}
        </a>
        <a class="dl-btn" href="{{ route('download.docx') }}">
            <i class="fa-regular fa-file-word"></i> {{ __('cv.download_docx') }}
        </a>
    </div>

    @yield('content')

    {{-- ── Scripts ────────────────────────────────────────────────── --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        AOS.init({ once: true });

        async function downloadPng() {
            const btn = document.getElementById('btn-png');
            btn.textContent = '⏳ …';

            // 1. Hide the floating UI bars so they don't appear in the capture
            document.querySelectorAll('.lang-bar,.dl-bar').forEach(el => el.style.display = 'none');

            // 2. Force ALL AOS-animated elements to their final visible state,
            //    regardless of whether they have scrolled into view yet.
            document.querySelectorAll('[data-aos]').forEach(el => {
                el.classList.add('aos-animate');
                el.removeAttribute('data-aos');        // prevent AOS re-hiding them
                el.style.transitionDuration = '0ms';   // skip transition flash
            });

            // 3. Scroll to top so html2canvas starts from the correct origin
            window.scrollTo(0, 0);

            // 4. Small settle delay
            await new Promise(r => setTimeout(r, 150));

            // 5. Capture just the CV card (not the full body with grey background)
            const target = document.querySelector('#cv-root .shadow-2xl') || document.getElementById('cv-root') || document.body;

            const canvas = await html2canvas(target, {
                useCORS: true,
                scale: 2,
                logging: false,
                backgroundColor: '#ffffff',
            });

            // 6. Restore UI
            document.querySelectorAll('.lang-bar,.dl-bar').forEach(el => el.style.display = '');
            btn.innerHTML = '<i class="fa-regular fa-image"></i> {{ __('cv.download_png') }}';

            const link    = document.createElement('a');
            link.download = 'cv-jelle-traa.png';
            link.href     = canvas.toDataURL('image/png');
            link.click();
        }
    </script>

    @stack('scripts')
</body>
</html>
