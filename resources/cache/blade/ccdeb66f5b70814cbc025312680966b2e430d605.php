

<?php $__env->startSection('title', L::_("History")); ?>
<?php $__env->startSection('url', url('home')); ?>

<?php $__env->startSection('content'); ?>
    <div class="manga-content mt-3" >
        <div id="history_content">
            <h2 class="h5 text-danger text-blod history-title" ><i class="icofont-history"></i> <?php echo e(L::_('History')); ?></h2>

            <div id="history_loading" class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    <script src="/manga18fx/js/history.js" type="text/javascript"></script>

    <script type="text/javascript">
        var page = 1;

        $(document).ready(function () {
            getHistorys(page, 'history-page')
        });

        window.addEventListener('scroll',()=>{
            console.log(window.scrollY) //scrolled from top
            console.log(window.innerHeight) //visible part of screen
            if(window.scrollY + window.innerHeight >=
                $("#history_content").prop("scrollHeight")){
                page = page + 1;
                getHistorys(page, 'history-page')
            }
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('themes.manga18fx.layouts.full', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\PHP\HMT\resources\views/themes/manga18fx/pages/history.blade.php ENDPATH**/ ?>