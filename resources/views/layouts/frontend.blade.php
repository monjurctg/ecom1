<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @if($gtext['is_rtl'] == 1) dir="rtl" class="rtl" @endif>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @yield('meta-content')

    <!-- Favicon -->
    <link rel="icon" href="{{ $gtext['favicon'] ? asset('public/media/' . $gtext['favicon']) : asset('public/backend/images/favicon.ico') }}" type="image/x-icon">

    <!-- Preload Critical Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&family=Spartan:wght@400;500;700;800;900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    @if($gtext['is_rtl'] == 1)
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    @endif

    <!-- Inline Critical CSS -->
    <style>
        :root {
            --theme-color: {{ $gtext['theme_color'] }};
            --color-green: {{ $gtext['green_color'] }};
            --color-light-green: {{ $gtext['light_green_color'] }};
            --color-lightness-green: {{ $gtext['lightness_green_color'] }};
            --color-gray: {{ $gtext['gray_color'] }};
            --color-gray-dark: {{ $gtext['dark_gray_color'] }};
            --color-gray-400: {{ $gtext['light_gray_color'] }};
            --color-black: {{ $gtext['black_color'] }};
            --color-white: {{ $gtext['white_color'] }};

            --primary-font-family: 'Roboto', sans-serif;
            --secondary-font-family: 'Spartan', sans-serif;
            --arabic-font-family: 'Noto Kufi Arabic', sans-serif;
            --font-size-100: 14px;
            --font-size-200: 16px;
            --font-size-300: 18px;
            --font-size-400: 20px;
            --font-size-500: 25px;
            --font-size-600: 30px;
            --font-size-700: 35px;
            --font-size-800: 40px;
            --font-size-900: 65px;
            --heading-1: 40px;
            --heading-2: 35px;
            --heading-3: 28px;
            --heading-4: 22px;
            --heading-5: 18px;
            --heading-6: 16px;
            --line-height-100: 1;
            --line-height-200: 1.5;
        }

        /* Loader & Scroll Top */
        .tw-loader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 9999; display: flex; justify-content: center; align-items: center; }
        .tw-ellipsis div { width: 12px; height: 12px; background: var(--theme-color); border-radius: 50%; display: inline-block; margin: 0 4px; animation: tw-bounce 1.4s infinite ease-in-out both; }
        .tw-ellipsis div:nth-child(1) { animation-delay: -0.32s; }
        .tw-ellipsis div:nth-child(2) { animation-delay: -0.16s; }
        @keyframes tw-bounce { 0%, 80%, 100% { transform: scale(0); } 40% { transform: scale(1.0); } }

        .scroll-to-top {
            position: fixed; bottom: 20px; right: 20px; width: 40px; height: 40px; background: var(--theme-color); color: white; border-radius: 50%; display: none; justify-content: center; align-items: center; z-index: 999; transition: all 0.3s;
            text-decoration: none;
        }
        .scroll-to-top:hover { background: #000; }
    </style>

    <!-- Load CSS Async (non-critical) -->
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/bootstrap-icons.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/magnific-popup.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/jquery-ui.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/slick.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/jquery.gritter.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Bootstrap (RTL or LTR) -->
    @if($gtext['is_rtl'] == 1)
        <link rel="preload" as="style" href="{{ asset('public/frontend/css/bootstrap.rtl.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="preload" as="style" href="{{ asset('public/frontend/css/rtl.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    @else
        <link rel="preload" as="style" href="{{ asset('public/frontend/css/bootstrap.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    @endif

    <!-- Main CSS -->
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/style.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('public/frontend/css/responsive.css') }}" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Custom CSS -->
    @if($gtext['custom_css'])
        <style>{!! $gtext['custom_css'] !!}</style>
    @endif

    <!-- Preconnect to External Domains -->
    <link rel="preconnect" href="https://connect.facebook.net">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://www.google-analytics.com">

    <!-- Google Tag Manager (head) -->
    @if($gtext['gtm_publish'] == 1)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $gtext["google_tag_manager_id"] }}');
        </script>
    @endif

    <!-- Facebook Pixel -->
    @if($gtext['fb_pixel_publish'] == 1)
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $gtext["fb_pixel_id"] }}');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $gtext['fb_pixel_id'] }}&ev=PageView&noscript=1"/></noscript>
    @endif

    <!-- Google Analytics -->
    @if($gtext['ga_publish'] == 1)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtext['tracking_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $gtext["tracking_id"] }}');
        </script>
    @endif
</head>

<body>
    <!-- Loader -->
    <div class="tw-loader">
        <div class="tw-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>

    <!-- Scroll to Top -->
    <a href="#top" class="scroll-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- GTM noscript fallback -->
    @if($gtext['gtm_publish'] == 1)
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtext['google_tag_manager_id'] }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <!-- Content -->
    @if($PageVariation['home_variation'] == 'home_3')
        <div class="container {{ $PageVariation['home_variation'] }}">
    @endif

    @yield('header')
    @yield('content')
    @include('frontend.partials.footer')

    @if($PageVariation['home_variation'] == 'home_3')
        </div>
    @endif

    <!-- Cookie Consent -->
    @if($gtext['is_publish_cookie_consent'] == 1)
        <div class="cookie_consent_card {{ $gtext['cookie_style'] }} {{ $gtext['cookie_position'] }}">
            @if($gtext['cookie_title'])
                <h4 class="cookie_consent_head">{{ $gtext['cookie_title'] }}</h4>
            @endif
            @if($gtext['cookie_message'])
                <div class="cookie_consent_text">
                    {{ $gtext['cookie_message'] }}
                    @if($gtext['learn_more_text'])
                        <a href="{{ $gtext['learn_more_url'] }}">{{ $gtext['learn_more_text'] }}</a>
                    @endif
                </div>
            @endif
            @if($gtext['button_text'])
                <button class="btn accept_btn">{{ $gtext['button_text'] }}</button>
            @endif
        </div>
    @endif

    <!-- JS: Load Critical First -->
    <script src="{{ asset('public/frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>

    <!-- Lazy Load Non-Critical JS -->
    <script>
        function loadScript(src) {
            const script = document.createElement('script');
            script.src = src;
            script.async = false;
            document.body.appendChild(script);
        }

        window.addEventListener('load', function () {
            [
                '{{ asset('public/frontend/js/owl.carousel.min.js') }}',
                '{{ asset('public/frontend/js/jquery.countdown.min.js') }}',
                '{{ asset('public/frontend/js/scrolltop.js') }}',
                '{{ asset('public/frontend/js/jquery-ui.min.js') }}',
                '{{ asset('public/frontend/js/jquery.magnific-popup.min.js') }}',
                '{{ asset('public/frontend/js/slick.min.js') }}',
                '{{ asset('public/frontend/js/jquery.popupoverlay.min.js') }}',
                '{{ asset('public/frontend/js/jquery.gritter.min.js') }}',
                '{{ asset('public/frontend/js/scripts.js') }}',
                '{{ asset('public/frontend/pages/cart.js') }}'
            ].forEach(loadScript);
        });
    </script>

    <!-- Inline JS -->
    <script>
        const isRTL = {{ $gtext['is_rtl'] ?? 0 }} == 1;
        const theme_color = "{{ $gtext['theme_color'] }}";
        const base_url = "{{ url('/') }}";
        const public_path = "{{ asset('public') }}";

        // Cookie Consent
        document.addEventListener('DOMContentLoaded', function () {
            const cookieModal = document.querySelector('.cookie_consent_card');
            const acceptBtn = document.querySelector('.accept_btn');

            if (cookieModal) {
                if (localStorage.getItem('cookie_consent')) {
                    cookieModal.classList.remove('active');
                } else {
                    cookieModal.classList.add('active');
                }

                if (acceptBtn) {
                    acceptBtn.addEventListener('click', function () {
                        cookieModal.classList.remove('active');
                        localStorage.setItem('cookie_consent', '1');
                    });
                }
            }
        });
    </script>

    <!-- Custom JS -->
    @if($gtext['custom_js'])
        <script>{!! $gtext['custom_js'] !!}</script>
    @endif

    @stack('scripts')
    @stack('style')
</body>
</html>