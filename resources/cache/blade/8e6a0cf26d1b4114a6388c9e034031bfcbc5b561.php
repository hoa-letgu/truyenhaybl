<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>

<?php echo '<?xml-stylesheet type="text/xsl" href="'.url('rss.xsl').'"?>'; ?>


<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
        <?php
        $metaConf = getConf('meta');
        ?>

        <title><?php echo e($metaConf['home_title']); ?></title>
        <link><?php echo e(url('home')); ?></link>
        <description><?php echo e($metaConf['home_description']); ?></description>

        <?php $__currentLoopData = $manga_rss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php

        $replaces = [
            '%manga_name%' => $rss->name,
            '%manga_description%' => $rss->description,
            '%other_name%' => $rss->other_name,
            '%site_name%' => $metaConf['site_name'],
        ];

        foreach ($replaces as $key => $value) {
            $metaConf['manga_title'] =
             str_replace($key, $value, $metaConf['manga_title']);
            $metaConf['manga_description'] =
            str_replace($key, $value, $metaConf['manga_description']);
        }
        ?>

        <item>
            <title><?php echo e($metaConf['manga_title']); ?></title>
            <link><?php echo e(manga_url($rss)); ?></link>
            <description>
                <?php echo e(strip_tags(!empty($rss->description) ? $rss->description : $metaConf['manga_description'])); ?>

            </description>
            <guid><?php echo e(manga_url($rss)); ?></guid>
            <atom:link href="<?php echo e(manga_url($rss)); ?>" rel="self" type="application/rss+xml"/>
            <enclosure url="<?php echo e($rss->cover); ?>" type="image/jpeg"/>
            <category><?php echo e($rss->name); ?></category>
            <author><?php echo e($metaConf['site_name']); ?></author>
            <pubDate><?php echo e(date('D, d M Y H:i:s O', strtotime($rss->last_update))); ?></pubDate>
        </item>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </channel>

</rss><?php /**PATH F:\PHP\HMT\resources\views/rss.blade.php ENDPATH**/ ?>