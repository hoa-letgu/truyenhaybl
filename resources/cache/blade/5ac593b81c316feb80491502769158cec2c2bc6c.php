<!DOCTYPE html>
<html lang="vi">
<head>
    <title><?php echo $__env->yieldContent('title', 'Hội Truyện Tranh - Cổng Truyện Tranh Số Một VN'); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <meta content="vi" http-equiv="content-language">
    
    <meta content="<?php echo $__env->yieldContent('description', 'Hội Truyện Tranh, Đọc Truyện Vip Miễn Phí Cập Nhật Cực Nhanh'); ?>" name="description">
    
    <meta content="Manga, Manhua, Manhwa HoiMeTruyen, đọc truyện online, truyện tranh online, truyện tranh, truyện" name="keywords">
    
    <meta content="website" property="og:type">
    
    <meta content="<?php echo $__env->yieldContent('url', url()); ?>" property="og:url">
    <link href="<?php echo $__env->yieldContent('url', url()); ?>" rel="canonical">

    <meta content="<?php echo $__env->yieldContent('title', 'Hội Truyện Tranh - Cổng Truyện Tranh Số Một VN'); ?>" property="og:title">
    
    <meta content="<?php echo $__env->yieldContent('image', '/mangareader/images/share.png'); ?>" itemprop="image" />
    <meta content="<?php echo $__env->yieldContent('image', '/mangareader/images/share.png'); ?>" name="thumbnail" />
    <meta content="<?php echo $__env->yieldContent('image', '/mangareader/images/share.png'); ?>" property="og:image">
    
    <meta content="433270358518416" property="fb:app_id">

    <meta content="<?php echo $__env->yieldContent('description', 'Hội Truyện Tranh, Đọc Truyện Vip Miễn Phí Với Hơn 100.000 Chương Truyện Tranh Tiếng Việt'); ?>" property="og:description">
    
    <link href="/favicon.ico?v=0.1" rel="shortcut icon">
    <link href="/mangareader/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="/manifest.json?v2" rel="manifest">
    <link color="#5f25a6" href="/mangareader/images/safari-pinned-tab.svg" rel="mask-icon">
    
    <meta content="#5f25a6" name="msapplication-TileColor">

    <link href="/manhwa18cc/css/css-main-v31.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/manhwa18cc/js/js-jquery-3.1.0.min.js"></script>

    
    <script>
        let isLoggedIn = <?php echo e(is_login() ? "true" : "false"); ?>;
    </script>

    <?php if (! empty(trim($__env->yieldContent('schema')))): ?>
        <?php echo $__env->yieldContent('schema'); ?>
    <?php else: ?>
        <script type="application/ld+json">
            <?php echo home_schema(); ?>

        </script>
    <?php endif; ?>

</head>
<body ng-app="myApp">

<?php echo $__env->make('themes.manhwa18cc.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('themes.manhwa18cc.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript" src="/manhwa18cc/js/1.5.6-angular.min.js" defer></script>
<script type="text/javascript" src="/manhwa18cc/js/1.5.6-angular-sanitize.min.js" defer></script>
<script type="text/javascript" src="/manhwa18cc/js/js-main.js" defer></script>
<script type="text/javascript" src="/manhwa18cc/js/js-jquery.star-rating-svg.js" defer></script>

<?php echo $__env->yieldContent('js-body'); ?>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GG3N4DZD64"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GG3N4DZD64');
</script>
</body>
</html><?php /**PATH /www/wwwroot/truyenhaybl.com/resources/views/themes/manhwa18cc/layouts/full.blade.php ENDPATH**/ ?>