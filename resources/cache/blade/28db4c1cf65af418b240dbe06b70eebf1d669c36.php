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
    
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="<?php echo $__env->yieldContent('title', $metaConf['home_title']); ?>">
    <meta itemprop="description" content="<?php echo $__env->yieldContent('description', $metaConf['home_description']); ?>">
    <meta itemprop="image" content="<?php echo $__env->yieldContent('image', $metaConf['home_image']); ?>">

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


    <link href="/favicon.ico?v=0.1" rel="shortcut icon">
    <link href="/mangareader/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="/manifest.json?v2" rel="manifest">
    <link color="#5f25a6" href="/mangareader/images/safari-pinned-tab.svg" rel="mask-icon">

    <meta content="#5f25a6" name="msapplication-TileColor">

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//pagead2.googlesyndication.com">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">

    <link href="<?php echo e(asset('mangareader/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('mangareader/css/fontawesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('mangareader/css/styles.min.css')); ?>" rel="stylesheet">

    <script>
        var layout = 'full';
        <?php if(is_login()): ?>
        var isLoggedIn = true
            , userID = '<?php echo e(userget()->id); ?>';
        <?php else: ?>
        var isLoggedIn = false;
        <?php endif; ?>

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

    <?php if (! empty(trim($__env->yieldContent('schema')))): ?>
    <?php echo $__env->yieldContent('schema'); ?>
    <?php else: ?>
    <script type="application/ld+json">
        <?php echo home_schema(); ?>

    </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('head'); ?>

</head>

<body>

    <?php echo $__env->make('themes.mangareader.components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="wrapper" <?php if (! empty(trim($__env->yieldContent('data-id')))): ?> data-manga-id="<?php echo $__env->yieldContent('data-id'); ?>" <?php endif; ?>>

        <?php echo $__env->make('themes.mangareader.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('themes.mangareader.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('themes.mangareader.components.modal-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->yieldContent('modal'); ?>
    </div>
    <?php
    $recaptcha = getConf('recaptcha');
    ?>
    <script>
        var recaptchaV3SiteKey = "<?php echo e($recaptcha['recaptchaV3SiteKey']); ?>";
        var recaptchaV2SiteKey = "<?php echo e($recaptcha['recaptchaV2SiteKey']); ?>";
    </script>

    <script src="<?php echo e(asset('mangareader/js/jquery.min.js')); ?>" type="text/javascript"></script>
    <script defer src="<?php echo e(asset('mangareader/js/lazysizes.min.js')); ?>"></script>

    <script defer src="<?php echo e(asset('mangareader/js/bootstrap.bundle.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('mangareader/js/toastr.min.js')); ?>" type="text/javascript"></script>

    <?php echo $__env->yieldContent('js-body'); ?>
    <script src="<?php echo e(asset('mangareader/js/main.min.js')); ?>" type="text/javascript"></script>


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

    <?php echo $__env->make('analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /www/wwwroot/hoimetruyen.com/resources/views/themes/mangareader/layouts/full.blade.php ENDPATH**/ ?>