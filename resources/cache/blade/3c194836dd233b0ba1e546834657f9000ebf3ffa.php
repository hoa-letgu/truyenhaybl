<?php
$siteConf = getConf('site');
$metaConf = getConf('meta');
?>
<?php echo $__env->make('ads.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('ads.body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html lang="<?php echo e($metaConf['language']); ?>">

<head>
    <title><?php echo $__env->yieldContent('title', $metaConf['home_title']); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="<?php echo e($metaConf['robots']); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <meta content="<?php echo e($metaConf['language']); ?>" http-equiv="content-language">

    <meta content="<?php echo $__env->yieldContent('description', $metaConf['home_description']); ?>" name="description">

    <meta content="website" property="og:type">
    <link rel="alternate" type="application/rss+xml" href="/rss" title="Farai's Codelab's RSS Feed" />

    <meta content="<?php echo $__env->yieldContent('url', url()); ?>" property="og:url">
    <link href="<?php echo $__env->yieldContent('url', url()); ?>" rel="canonical">

    <meta content="<?php echo $__env->yieldContent('title', $metaConf['home_title']); ?>" property="og:title">

    <meta content="<?php echo $__env->yieldContent('image', '/mangareader/images/share.png'); ?>" itemprop="image" />
    <meta content="<?php echo $__env->yieldContent('image', '/mangareader/images/share.png'); ?>" name="thumbnail" />
    <meta content="<?php echo $__env->yieldContent('image', '/mangareader/images/share.png'); ?>" property="og:image">

    <meta content="<?php echo e(getConf('site')['FBAppID']); ?>" property="fb:app_id">

    <meta content="<?php echo $__env->yieldContent('description', $metaConf['home_description']); ?>" property="og:description">

    <link href="/favicon.ico?v=0.1" rel="shortcut icon">
    <link href="/mangareader/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="/manifest.json?v2" rel="manifest">
    <link color="#5f25a6" href="/mangareader/images/safari-pinned-tab.svg" rel="mask-icon">

    <meta content="#5f25a6" name="msapplication-TileColor">


    <link href="/manga18fx/css/main.min.css" rel='stylesheet' type='text/css' />

    <script type="text/javascript" src="/manga18fx/js/js-jquery-3.6.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        let isLoggedIn = <?php echo e(is_login() ? "true" : "false"); ?>,
            slugConf = {
                manga: '<?php echo e(getConf('slug')['manga']); ?>'
            };

    </script>

    <style>
        body {
            font-family: "Source Sans Pro", "Sofia Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }
    </style>

    <?php if (! empty(trim($__env->yieldContent('schema')))): ?>
    <?php echo $__env->yieldContent('schema'); ?>
    <?php else: ?>
    <script type="application/ld+json">
        <?php echo home_schema(); ?>

    </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('head'); ?>
</head>

<body ng-app="myApp" class="bodymode">

    <?php echo $__env->make('themes.manga18fx.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('themes.manga18fx.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script type="text/javascript" src="/manga18fx/js/1.5.6-angular.min.js" defer></script>
    <script type="text/javascript" src="/manga18fx/js/1.5.6-angular-sanitize.min.js" defer></script>
    <script type="text/javascript" src="/manga18fx/js/js-main.js" defer></script>
    <script type="text/javascript" src="/manga18fx/js/js-jquery.star-rating-svg.js"></script>

    <?php echo $__env->yieldContent('js-body'); ?>

    <?php if(!empty($siteConf['analytics_id'])): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($siteConf['analytics_id']); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '<?php echo e($siteConf['analytics_id']); ?>');
    </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('body'); ?>
</body>

</html><?php /**PATH F:\PHP\HMT\resources\views/themes/manga18fx/layouts/full.blade.php ENDPATH**/ ?>