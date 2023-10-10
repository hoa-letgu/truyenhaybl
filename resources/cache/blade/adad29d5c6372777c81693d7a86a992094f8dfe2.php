

<?php $__env->startSection('title', L::_('Notification')); ?>

<?php $__env->startSection('content'); ?>
<div id="main-wrapper">
    <div class="container">
        <div id="mw-2col">
            <div id="main-content">
                <!--Begin: main-content-->
                <section class="block_area block_area_profile">
                    <div class="block_area-header">
                        <div class="bah-heading">
                            <h2 class="cat-heading">Notifications</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="block_area-content">
                        <div class="inbox-list">
                            <div class="inbox-tabs">
                                <div class="float-right">
                                    <a data-position="page" class="btn btn-sm btn-blank notify-seen-all" style="font-size: 12px;"><i class="fas fa-check mr-1"></i> Mark <span class="d-none d-sm-inline">all as</span> read</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        <div class="inbox-item-list">
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="inbox-item ">
                                <div class="ii-content">
                                    <div class="ii-text">
                                        <?php if($notification->url): ?>
                                        <a href="<?php echo e($notification->url); ?>" class="ii-link">
                                             <?php echo $notification->msg; ?>

                                        </a>
                                        <?php else: ?>
                                        <?php echo $notification->msg; ?>

                                        <?php endif; ?>
                                            
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="pre-pagination mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <?php if($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link href="<?php echo e(url(null, null, [
                                            'page' => $page,
                                        ])); ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    
                                    <?php for($i = ($page > 2 ? $page - 2 : 1); $i <= ($page>= $totalPage - 2 ? $totalPage : $page + 2) ; $i++): ?>                                
                                    <li class="page-item <?php echo e($i == $page ? 'active' : ''); ?>">
                                        <a class="page-link" href="<?php echo e(url(null, null, [
                                            'page' => $i,
                                        ])); ?>"><?php echo e($i); ?></a>
                                    </li>
                                    <?php endfor; ?>


                                    <?php if($page < $totalPage): ?>
                                    <li class="page-item">
                                        <a class="page-link <?php echo e($page == $totalPage ? 'disable' : ''); ?>" href="<?php echo e(url(null, null, [



                                            'page' => $page < $totalPage ? $page + 1 : $totalPage,
                                        ])); ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </section>
                <!--/End: main-content-->
  </div>



                <!--Begin: main-sidebar-->
                <?php echo $__env->make('themes.mangareader.components.user.main-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--/End: main-sidebar-->
                <div class="clearfix"></div>
          
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.mangareader.layouts.full', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/hoimetruyen.com/resources/views/themes/mangareader/pages/notification.blade.php ENDPATH**/ ?>