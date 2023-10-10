<?php
$siteConf = getConf('site');
$metaConf = getConf('meta');
?>
@include('ads.head')
@include('ads.body')
        <!DOCTYPE html>
<html lang="{{ getConf('site')['lang'] }}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="HandheldFriendly" content="true"/>

    <title>@yield('title', $metaConf['home_title'])</title>

    <meta name="robots" content="index,follow">
    <meta name="distribution" content="web">

    <meta http-equiv="content-type" content="text/html;UTF-8">
    <meta http-equiv="content-language" content="{{ getConf('site')['lang'] }}">
    <meta http-equiv="content-security-policy" content="upgrade-insecure-requests">
    <meta name="description" content="@yield('description', $metaConf['home_description'])">

    <meta property="og:title" content="@yield('title', $metaConf['home_title'])"/>

    <meta property="og:site_name" data-page-subject="true" content="{{ $metaConf['site_name'] }}"/>
    <meta property="og:url" content="@yield('url', url())"/>

    <meta property="og:description" name="description" content="@yield('description', $metaConf['home_description'])"/>

    <meta property="og:type" content="website"/>

    <meta property="fb:admins" content="100029967223133"/>
    <meta property="fb:pages" content="104519122365478"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="@yield('title', $metaConf['home_title'])">
    <meta itemprop="description" content="@yield('description', $metaConf['home_description'])">
    <!-- Twitter Card data -->
    <meta name="twitter:card"
          content="@yield("image", "https://i.imgur.com/sqCh4Yo.jpeg")">
    <!-- summary_large_image -->
    <meta name="twitter:site" content="{{ $metaConf['site_name'] }}">
    <meta name="twitter:title" content="@yield('title', $metaConf['home_title'])"> <!-- Page title again -->
    <meta name="twitter:description" content="@yield('description', $metaConf['home_description'])">
    <!-- Page description less than 200 characters -->
    <meta name="twitter:creator" content="@nghia34522693"> <!-- @username for the content creator / author. -->


    <meta property="og:image"
          content="@yield("image", "https://i.imgur.com/sqCh4Yo.jpeg")"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>

    <link rel="manifest" href="/manifest.webmanifest"/>

    <link rel="icon" type="image/png" sizes="192x192" href="/icon-192x192.png">
    <link rel="icon" type="image/png" sizes="256x256" href="/icon-256x256.png">
    <link rel="icon" type="image/png" sizes="384x384" href="/icon-384x384.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/icon-512x512.png">

    <link href="/kome/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/kome/assets/css/main.css" rel="stylesheet" type="text/css"/>

    @yield("head-css")

    <link href="/kome/assets/css/responsive.css" rel="stylesheet" type="text/css"/>

    <link rel="preconnect" href="https://fonts.gstatic.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin/>
    <link rel="preload" as="font" href="/kome/assets/fonts/vncomic.ttf" crossorigin="anonymous"/>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">

    <link rel="alternate" type="application/rss+xml" title="{{ $metaConf['site_name'] }} » Feed"
          href="{{ url("rss") }}">

    <style>
        body {
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }
    </style>

    <link href="/kome/assets/css/fontcomic.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
        var isLoggedIn = {{ is_login() ? '1' : '0' }};
        const csrf_token = "{{ csrf_token() }}";
        var siteURL = "{{ $siteConf['site_url'] }}";
        var lang = {
            Bookmark: "{{ L::_("Bookmark") }}",
            UnBookmark: "{{ L::_("UnBookmark") }}",
            MustBeLogin: "{{ L::_("You need to be logged in to use this function!") }}",
            See_more: "{{ L::_("View More") }}",
            See_less: "{{ L::_("Collapse") }}"
        };
    </script>
</head>
<body>

@include("themes.kome.components.header")
@include("themes.kome.components.navbar-breadcrumb")

@yield("content")

<script src="/kome/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="/kome/assets/js/global.js" type="text/javascript"></script>
<script src="/kome/assets/js/bootstrap.js" type="text/javascript"></script>
<script src="/kome/assets/js/default.js" type="text/javascript"></script>
<script src="/kome/assets/js/scrolltotop.js" type="text/javascript"></script>
<script src="/kome/assets/js/jquery.lazyload.min.js" type="text/javascript"></script>

@yield("body-js")

<script type="text/javascript">jQuery(window).bind("load", function () {
        jQuery('.fed-lazy').lazy({
            effect: "fadeIn",
        });
    });


</script>

@include("themes.kome.components.footer")

<script>
    if ('serviceWorker' in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register('/sw.js').then(function (registration) {
            console.log('Service worker registration succeeded:', registration);
        }, /*catch*/ function (error) {
            console.log('Service worker registration failed:', error);
        });
    } else {
        console.log('Service workers are not supported.');
    }
</script>
</body>
</html>