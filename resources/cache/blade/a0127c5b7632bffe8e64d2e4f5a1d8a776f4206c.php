
<?php $__env->startSection('title', $seo_title . ' - Hội Mê Truyện'); ?>

<?php $__env->startSection('content'); ?>
    <div class="manga-content wleft">
        <div class="centernav">
            <div class="manga-body wleft">
                <div class="content-manga-list">
                    <div class="list-block wleft">
                        <div class="block-title order-block-title wleft">
                            <h1 class="bktitle">
                                <i class="icofont-favourite"></i>
                                <?php echo e($heading_title); ?>

                            </h1>
                            <?php if($sort !== false): ?>
                                <div class="order-nav-tabs">
                                    <span> <?php echo e(L::_("Order by")); ?> </span>
                                    <ul class="c-tabs-content">
                                        <?php $__currentLoopData = sortType(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sort_id => $sort_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($sort !== $sort_id): ?>
                                                <li class="">
                                                    <a href="<?php echo e(url($url, null, ['sort' => $sort_id])); ?>" class="">
                                                        <?php echo e($sort_name); ?>

                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li class="active">
                                                    <a href="<?php echo e(url($url, null, ['sort' => $sort_id])); ?>" class="">
                                                        <?php echo e($sort_name); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="manga-lists">
                            <?php $__currentLoopData = $mangas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="manga-item">
                                    <div class="bsx wleft">
                                        <div class="thumb">
                                            <a href="<?php echo e(url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id])); ?>"
                                               title="<?php echo e($manga->name); ?>">
                                                <img data-src="<?php echo e($manga->cover); ?>" class="lazyload"
                                                     src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                                     alt="<?php echo e($manga->name); ?>">
                                            </a>
                                        </div>
                                        <div class="data wleft">
                                            <h3>
                                                <a href="<?php echo e(url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id])); ?>"
                                                   title="<?php echo e($manga->name); ?>">
                                                    <?php echo e($manga->name); ?> </a>
                                            </h3>
                                            <div class="item-rate wleft">
                                                <div class="my-rating jq-stars" data-rating="<?php echo e($manga->rating_score / 2); ?>"></div>
                                                <span><?php echo e(floor(($manga->rating_score / 2) * 2) / 2); ?></span>
                                            </div>
                                            <div class="list-chapter wleft">
                                                <?php $__currentLoopData = array_slice(get_manga_data('chapters', $manga->id, []), 0 , 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="chapter-item wleft">
                                                    <span class="chapter">
                                                        <a href="<?php echo e(url('chapter', ['m_slug' => $manga->slug, 'c_slug' => $chapter->slug, 'c_id' => $chapter->id ])); ?>"
                                                           class="btn-link"
                                                           title="<?php echo e($manga->name); ?> <?php echo e($chapter->name); ?>"> <?php echo e($chapter->name); ?> </a>
                                                    </span>
                                                        <?php if((strtotime('now') - strtotime($chapter->last_update)) < 86400): ?>
                                                            <span class="post-on">
                                                        <span class="c-new-tag">
                                                        <img style="width: 30px; height: 16px;"
                                                             src="/manhwa18cc/images/images-new.gif"
                                                             alt="<?php echo e($manga->name); ?> <?php echo e($chapter->name); ?>">
                                                        </span>
                                                    </span>
                                                        <?php else: ?>
                                                            <span class="post-on">
                                                        <span class="c-new-tag">
                                                        <?php echo e(time_convert($chapter->last_update)); ?>

                                                        </span>
                                                    </span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="blog-pager wleft tcenter" id="blog-pager">
                                <ul class="pagination">
                                    <?php if($paginate->current_page <= 1): ?>
                                        <li class="prev disabled"><span>«</span></li>
                                    <?php else: ?>
                                        <li class="prev">
                                            <a href="<?php echo e(url(null, ['page' => $paginate->current_page - 1], $params)); ?>"
                                               data-page="<?php echo e($paginate->current_page - 1); ?>">«</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($paginate->current_page - 1 <= 0): ?>
                                        <li class="active">
                                            <a href="<?php echo e(url()); ?>"
                                               data-page="<?php echo e($paginate->current_page); ?>"><?php echo e($paginate->current_page); ?></a>
                                        </li>
                                    <?php else: ?>
                                        <li class="">
                                            <a href="<?php echo e(url(null, ['page' => $paginate->current_page - 1], $params)); ?>"
                                               data-page="<?php echo e($paginate->current_page - 1); ?>"><?php echo e($paginate->current_page - 1); ?></a>
                                        </li>
                                        <li class="active">
                                            <a href="<?php echo e(url(null, ['page' => $paginate->current_page], $params)); ?>"
                                               data-page="<?php echo e($paginate->current_page); ?>"><?php echo e($paginate->current_page); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php
                                    $next_pages = [1, 2, 3];
                                    ?>
                                    <?php $__currentLoopData = $next_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pagenext): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($paginate->current_page + $pagenext <=$paginate->total_page): ?>
                                            <li><a href="<?php echo e(url(null, ['page' => $paginate->current_page + $pagenext], $params)); ?>"
                                                   data-page="<?php echo e($paginate->current_page + $pagenext); ?>"><?php echo e($paginate->current_page + $pagenext); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <?php if($paginate->current_page < $paginate->total_page): ?>
                                        <li class="next">
                                            <a href="<?php echo e(url(null, ['page' => $paginate->current_page + 1], $params)); ?>" data-page="<?php echo e($paginate->current_page + 1); ?>">»</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="next disabled">
                                            <span>»</span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('modal'); ?>
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('js-body'); ?>
            <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>

            <script type="text/javascript">
                $("img.lazyload").lazyload();

                $(document).ready(function () {
                    $(".my-rating").starRating({
                        totalStars: 5,
                        starShape: 'straight',
                        starSize: 16,
                        emptyColor: 'lightgray',
                        hoverColor: 'salmon',
                        activeColor: '#ffd900',
                        useGradient: false,
                        readOnly: true
                    });
                });

            </script>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('themes.manhwa18cc.layouts.full', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/truyenhaybl.com/resources/views/themes/manhwa18cc/pages/manga-list.blade.php ENDPATH**/ ?>