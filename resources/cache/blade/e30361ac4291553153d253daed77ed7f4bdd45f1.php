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

    <!-- Primary Meta Tags -->
    <meta name="title" content="<?php echo $__env->yieldContent('title', $metaConf['home_title']); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('description', $metaConf['home_description']); ?>">

    <?php if(!empty($metaConf['google_site_verification'])): ?>
    <meta name="google-site-verification" content="<?php echo e($metaConf['google_site_verification']); ?>">
    <?php endif; ?>
    <?php if(!empty($metaConf['bing_site_verification'])): ?>
    <meta name="msvalidate.01" content="<?php echo e($metaConf['bing_site_verification']); ?>">
    <?php endif; ?>

    <?php if(isset($metaConf['author'])): ?>
        <meta name="author" content="<?php echo e($metaConf['author']); ?>">
    <?php endif; ?>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', $metaConf['home_title']); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('description', $metaConf['home_description']); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('image', $metaConf['home_image']); ?>">
    <?php if(!empty($siteConf['FBAppID'])): ?>
    <meta property="fb:app_id" content="<?php echo e($siteConf['FBAppID']); ?>">
    <?php endif; ?>


    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(url()); ?>">
    <meta property="twitter:title" content="<?php echo $__env->yieldContent('title', $metaConf['home_title']); ?>">
    <meta property="twitter:description" content="<?php echo $__env->yieldContent('description', $metaConf['home_description']); ?>">
    <meta property="twitter:image" content="<?php echo $__env->yieldContent('image', $metaConf['home_image']); ?>">

    
    <link rel="alternate" type="application/rss+xml" title="<?php echo e($metaConf['site_name']); ?>" href="<?php echo e(url('rss')); ?>">

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

</html><?php /**PATH /www/wwwroot/hoimetruyen.com/resources/views/themes/manga18fx/layouts/full.blade.php ENDPATH**/ ?>