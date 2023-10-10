<?php
$siteConf = getConf('site');
$metaConf = getConf('meta');

if(!isset($metaConf['language'])) {
    $metaConf['language'] = 'en';
}

if(!isset($metaConf['robots'])) {
    $metaConf['robots'] = 'index, follow';
}

if(!isset($metaConf['author'])) {
    $metaConf['author'] = $metaConf['site_name'];
}

if(!isset($metaConf['home_image'])) {
    $metaConf['home_image'] = url('/images/share.png');
}
?>

<!DOCTYPE html>
<html lang="{{ $metaConf['language'] }}">

<head>
    <title>@yield('title', $metaConf['home_title'])</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="{{ $metaConf['robots'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <meta content="{{ $metaConf['language'] }}" http-equiv="content-language">

    <!-- Primary Meta Tags -->
    <meta name="title" content="@yield('title', $metaConf['home_title'])">
    <meta name="description" content="@yield('description', $metaConf['home_description'])">

    @if(!empty($metaConf['google_site_verification']))
    <meta name="google-site-verification" content="{{ $metaConf['google_site_verification'] }}">
    @endif
    @if(!empty($metaConf['bing_site_verification']))
    <meta name="msvalidate.01" content="{{ $metaConf['bing_site_verification'] }}">
    @endif

    @if(isset($metaConf['author']))
        <meta name="author" content="{{ $metaConf['author'] }}">
    @endif

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url() }}">
    <meta property="og:title" content="@yield('title', $metaConf['home_title'])">
    <meta property="og:description" content="@yield('description', $metaConf['home_description'])">
    <meta property="og:image" content="@yield('image', $metaConf['home_image'])">
    @if(!empty($siteConf['FBAppID']))
    <meta property="fb:app_id" content="{{ $siteConf['FBAppID'] }}">
    @endif

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url() }}">
    <meta property="twitter:title" content="@yield('title', $metaConf['home_title'])">
    <meta property="twitter:description" content="@yield('description', $metaConf['home_description'])">
    <meta property="twitter:image" content="@yield('image', $metaConf['home_image'])">

    <link rel="alternate" type="application/rss+xml" title="{{ $metaConf['site_name'] }}" href="{{ url('rss') }}">

    <link href="/favicon.ico?v=0.1" rel="shortcut icon">
    <link href="/mangareader/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="/manifest.json?v2" rel="manifest">
    <link color="#5f25a6" href="/images/safari-pinned-tab.svg" rel="mask-icon">

    <meta content="#5f25a6" name="msapplication-TileColor">

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//pagead2.googlesyndication.com">

    <!--<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">-->

    <link href="{{ asset('mangareader/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mangareader/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mangareader/css/styles.min.css') }}" rel="stylesheet">


    <script>
        var layout = 'read';
        const token = "{{ bin2hex(base64_encode($_ENV['SECRET_KEY'])) }}";

        const listServer = {!! @json_encode(getConf('proxy-server')) !!}; 
        @if(is_login())
        var isLoggedIn = true;
        var userID = '{{userget()->id }}';
        @else
        var isLoggedIn = false;
        @endif

    </script>

    <style>
        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: 'PoppinsVN', sans-serif;
        }
    </style>


    <script type="application/ld+json">
        {
            "@context": "http://schema.org"
            , "@type": "Person"
            , "name": "{{ getConf("meta")['site_name'] }}"
            , "url": "{{ getConf("site")['site_url'] }}"
        , }

    </script>

    @yield('head')

</head>

<body class="page-reader">
    <script>
        var uiMode = localStorage.getItem('uiMode');
        const body = document.body
            , btnMode = document.getElementById('toggle-mode')
            , sbBtnMode = document.getElementById('sb-toggle-mode');

        function activeUiMode() {
            if (uiMode === 'dark') {
                btnMode && btnMode.classList.add('active');
                sbBtnMode && sbBtnMode.classList.add('active');
                body.classList.add("darkmode");
            } else {
                btnMode && btnMode.classList.remove('active');
                sbBtnMode && sbBtnMode.classList.remove('active');
                body.classList.remove("darkmode");
            }
        }

        if (uiMode) {
            activeUiMode();
        } else {
            window.matchMedia('(prefers-color-scheme: dark)').matches ? uiMode = 'dark' : uiMode = 'light';
            activeUiMode();
        }
        [btnMode, sbBtnMode].forEach(item => {
            if (item) {
                item.addEventListener('click', function() {
                    this.classList.contains('active') ? uiMode = 'light' : uiMode = 'dark';
                    localStorage.setItem('uiMode', uiMode);
                    activeUiMode();
                });
            }
        })

    </script>
    @yield('content')
    @include('themes.mangareader.components.modal-login')

    <script>
        var recaptchaV3SiteKey = '6LcAhLscAAAAAMZLXweNWhQAF3YuYm1QRPNUZb18'
            , recaptchaV2SiteKey = '6Lcig7scAAAAAGO9AdHg3j-mEcPEA7v9F488uiLq';

    </script>

    <script type="text/javascript" src="{{ asset('mangareader/js/jquery.min.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('mangareader/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('mangareader/js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('mangareader/js/js.cookie.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/mobile-detect@1.4.5/mobile-detect.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js"></script>

    @yield('js-body')
    <script src="{{ asset('mangareader/js/fotosecure.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('mangareader/js/main.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('mangareader/js/comment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('mangareader/js/read.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                getScript('https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js');
            }, 1000);
        });

        var manga_url = '{{ $manga_url }}';

        window.onpopstate = function(e) {
            e.preventDefault();
            window.history.back();
        }

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js?v=3');
            });
        }

    </script>
    
    @include('analytics')
</body>

</html>