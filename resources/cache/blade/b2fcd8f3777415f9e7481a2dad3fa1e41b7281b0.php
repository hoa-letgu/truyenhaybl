<?php if($chapter_data->type === 'image'): ?>
    <?php $__currentLoopData = $chapter_data->content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="image-placeholder">
            <img class="p<?php echo e($key); ?> lazy-load" data-src="<?php echo e($image); ?>"
                 src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" alt="Page <?php echo e($key); ?>">
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <script>
        $.post("/ajax/manga/count-view/" + chapter_id);

        const imgLazyObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Chép link ảnh qua src
                    entry.target.src = entry.target.dataset?.src;
                    entry.target.classList.add('loaded');
                    // bỏ theo dõi bức ảnh này
                    observer.unobserve(entry.target);
                }
            });
        }, {
            // Chạy callback ở trên khi ảnh vừa vào view-port
            threshold: 0
        });

        document.querySelectorAll('img.lazy-load').forEach(img => {
            imgLazyObserver.observe(img)
        });
    </script>

    <style>
        .image-placeholder {
            width: fit-content;
            position: relative;
            min-height: 50px;
            background-color: rgba(252, 252, 252, 0.67);
            margin: auto;
        }


    </style>
<?php else: ?>
    <div class="tleft">
        <?php echo $chapter_data->content; ?>

    </div>
    <style>

    </style>
<?php endif; ?><?php /**PATH /www/wwwroot/truyenhaybl.com/resources/views/themes/manhwa18cc/components/chapter/vertical-image-list.blade.php ENDPATH**/ ?>