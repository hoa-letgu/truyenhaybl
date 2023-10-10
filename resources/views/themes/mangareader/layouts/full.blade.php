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

@include('ads.head')
@include('ads.body')

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
    
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="@yield('title', $metaConf['home_title'])">
    <meta itemprop="description" content="@yield('description', $metaConf['home_description'])">
    <meta itemprop="image" content="@yield('image', $metaConf['home_image'])">

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
    <link color="#5f25a6" href="/mangareader/images/safari-pinned-tab.svg" rel="mask-icon">

    <meta content="#5f25a6" name="msapplication-TileColor">

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//pagead2.googlesyndication.com">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">

    <link href="{{ asset('mangareader/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mangareader/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mangareader/css/styles.min.css') }}" rel="stylesheet">

    <script>
        var layout = 'full';
        @if(is_login())
        var isLoggedIn = true
            , userID = '{{userget()->id }}';
        @else
        var isLoggedIn = false;
        @endif

    </script>

    <style>
        .manga_list-sbs .mls-wrap .item .manga-detail .fd-list .fdl-item .chapter a:visited {
            color: #999;
        }

        body.darkmode .manga_list-sbs .mls-wrap .item .manga-detail .fd-list .fdl-item .chapter a:visited {
            color: #b5b5b5;

        }

        .blur-up {
            -webkit-filter: blur(5px);
            filter: blur(5px);
            transition: filter 400ms, -webkit-filter 400ms;
        }

        .blur-up.lazyloaded {
            -webkit-filter: blur(0);
            filter: blur(0);
        }

    </style>

    @hasSection('schema')
    @yield('schema')
    @else
    <script type="application/ld+json">
        {!! home_schema() !!}
    </script>
    @endif

    @yield('head')

</head>

<body>

    @include('themes.mangareader.components.sidebar')

    <div id="wrapper" @hasSection('data-id') data-manga-id="@yield('data-id')" @endif>

        @include('themes.mangareader.components.header')
        @yield('content')
        @include('themes.mangareader.components.footer')
        @include('themes.mangareader.components.modal-login')
        {{-- @ include('themes.mangareader.components.modal-ads')--}}
        @yield('modal')
    </div>
    @php
    $recaptcha = getConf('recaptcha');
    @endphp
    <script>
        var recaptchaV3SiteKey = "{{ $recaptcha['recaptchaV3SiteKey'] }}";
        var recaptchaV2SiteKey = "{{ $recaptcha['recaptchaV2SiteKey'] }}";
    </script>

    <script src="{{ asset('mangareader/js/jquery.min.js') }}" type="text/javascript"></script>
    <script defer src="{{ asset('mangareader/js/lazysizes.min.js') }}"></script>

    <script defer src="{{ asset('mangareader/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('mangareader/js/toastr.min.js') }}" type="text/javascript"></script>

    @yield('js-body')
    <script src="{{ asset('mangareader/js/main.min.js') }}" type="text/javascript"></script>


    <script>
        $(document).ready(function() {

            setTimeout(function() {

                if (isLoggedIn) {
                    $.get('/ajax/notification/latest', function(res) {
                        $('.hr-notifications').html(res.html);
                    })
                }
            }, 2000);


        });

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js?v=3');
            });
        }

    </script>

    @include('analytics')
</body>

</html>
