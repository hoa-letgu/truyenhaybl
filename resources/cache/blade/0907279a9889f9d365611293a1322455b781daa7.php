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

    <link href="/favicon.ico?v=0.1" rel="shortcut icon">
    <link href="/mangareader/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="/manifest.json?v2" rel="manifest">
    <link color="#5f25a6" href="/images/safari-pinned-tab.svg" rel="mask-icon">

    <meta content="#5f25a6" name="msapplication-TileColor">

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//pagead2.googlesyndication.com">

    <!--<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">-->

    <link href="<?php echo e(asset('mangareader/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('mangareader/css/fontawesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('mangareader/css/styles.min.css')); ?>" rel="stylesheet">


    <script>
        var layout = 'read';
        const token = "<?php echo e(bin2hex(base64_encode($_ENV['SECRET_KEY']))); ?>";

        const listServer = <?php echo @json_encode(getConf('proxy-server')); ?>; 
        <?php if(is_login()): ?>
        var isLoggedIn = true;
        var userID = '<?php echo e(userget()->id); ?>';
        <?php else: ?>
        var isLoggedIn = false;
        <?php endif; ?>

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
            , "name": "<?php echo e(getConf("meta")['site_name']); ?>"
            , "url": "<?php echo e(getConf("site")['site_url']); ?>"
        , }

    </script>

    <?php echo $__env->yieldContent('head'); ?>

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
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('themes.mangareader.components.modal-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        var recaptchaV3SiteKey = '6LcAhLscAAAAAMZLXweNWhQAF3YuYm1QRPNUZb18'
            , recaptchaV2SiteKey = '6Lcig7scAAAAAGO9AdHg3j-mEcPEA7v9F488uiLq';

    </script>

    <script type="text/javascript" src="<?php echo e(asset('mangareader/js/jquery.min.js')); ?>"></script>
    <script defer type="text/javascript" src="<?php echo e(asset('mangareader/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('mangareader/js/toastr.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('mangareader/js/js.cookie.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/mobile-detect@1.4.5/mobile-detect.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js"></script>

    <?php echo $__env->yieldContent('js-body'); ?>
    <script src="<?php echo e(asset('mangareader/js/fotosecure.min.js')); ?>" type="text/javascript"></script>

    <script src="<?php echo e(asset('mangareader/js/main.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('mangareader/js/comment.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('mangareader/js/read.js')); ?>" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                getScript('https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js');
            }, 1000);
        });

        var manga_url = '<?php echo e($manga_url); ?>';

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
    
    <?php echo $__env->make('analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH /www/wwwroot/hoimetruyen.com/resources/views/themes/mangareader/layouts/read.blade.php ENDPATH**/ ?>