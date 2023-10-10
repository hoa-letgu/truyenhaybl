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

    <!-- Favicon -->
    <link href="/favicon.ico" rel="shortcut icon">

    <!-- Manifest -->
    <link href="/manifest.json" rel="manifest">

    <!-- Primary CSS -->
    <link href="/manga18fx/css/main.min.css" rel='stylesheet' type='text/css' />
    <script type="text/javascript" src="/manga18fx/js/js-jquery-3.6.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        let isLoggedIn = {{ is_login() ? "true" : "false" }},
            slugConf = {
                manga: '{{ getConf('slug')['manga'] }}'
            };

    </script>

    <style>
        body {
            font-family: "Source Sans Pro", "Sofia Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }
    </style>

    @hasSection('schema')
    @yield('schema')
    @else
    <script type="application/ld+json">
        {!!home_schema()!!}
    </script>
    @endif

    @yield('head')
</head>

<body ng-app="myApp" class="bodymode">

    @include('themes.manga18fx.components.header')

    @yield('content')

    @include('themes.manga18fx.components.footer')


    <script type="text/javascript" src="/manga18fx/js/1.5.6-angular.min.js" defer></script>
    <script type="text/javascript" src="/manga18fx/js/1.5.6-angular-sanitize.min.js" defer></script>
    <script type="text/javascript" src="/manga18fx/js/js-main.js" defer></script>
    <script type="text/javascript" src="/manga18fx/js/js-jquery.star-rating-svg.js"></script>

    @yield('js-body')

    @if(!empty($siteConf['analytics_id']))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteConf['analytics_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '{{ $siteConf['analytics_id'] }}');
    </script>
    @endif

    @yield('body')
</body>

</html>