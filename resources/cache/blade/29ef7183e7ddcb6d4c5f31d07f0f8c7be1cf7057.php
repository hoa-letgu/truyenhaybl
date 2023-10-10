
<?php $__env->startSection('title', 'Hội Mê Truyện - Cổng Truyện Tranh Số Một VN'); ?>
<?php $__env->startSection('description', 'Hội Mê Truyện, Đọc Truyện Vip Miễn Phí Với 100.000 Chương Truyện Tranh Tiếng Việt'); ?>
<?php $__env->startSection('url', url('home')); ?>

<?php $__env->startSection('content'); ?>
    <div class="manga-content wleft">
        <div class="centernav">
            <div class="manga-body wleft">
                <div class="content-manga-list">
                    <div class="list-block popular-block wleft">
                        <div class="block-title wleft">
                            <h2 class="bktitle">
                                <i class="icofont-flash"></i>
                                <?php echo e(L::_('HOT MANHWA UPDATES')); ?>

                            </h2>
                        </div>
                        <div class="popular-items">
                            <?php $__currentLoopData = (new Models\Manga())->pin_manga(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="hot-item">
                                    <a href="<?php echo e(url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id])); ?>"
                                       title="<?php echo e($manga->name); ?>">
                                        <div class="himg">
                                            <div class="chapter-badges">
                                                <?php if($chapters = get_manga_data('chapters', $manga->id)): ?>
                                                    <?php echo e($chapters[0]->name); ?>

                                                <?php endif; ?>
                                            </div>
                                            <img class="lazyload" data-src="<?php echo e($manga->cover); ?>"
                                                 src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                                                 alt="<?php echo e($manga->name); ?>">
                                        </div>
                                        <div class="caption">
                                            <h4><?php echo e($manga->name); ?></h4>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="list-block wleft">
                        <div class="block-title wleft">
                            <h1 class="bktitle">
                                <i class="icofont-flash"></i>
                                <?php echo e(L::_('LATEST MANHWA UPDATES')); ?>

                            </h1>
                        </div>
                        <div class="manga-lists">
                            <?php $__currentLoopData = (new Models\Manga())->new_update(1, 24); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                <a href="<?php echo e(url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id])); ?>" title="<?php echo e($manga->name); ?>">
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

                            <?php
                            $current_page = 1;
                            $num = 5
                            ?>
                            <div class="blog-pager wleft tcenter" id="blog-pager">
                                <ul class="pagination">
                                    <li class="prev disabled">
                                        <span>«</span>
                                    </li>
                                    <?php for($i = 1 ; $i <= $num ; $i++): ?>
                                        <li class="<?php echo e($current_page === $i ? 'active' : ''); ?>">
                                            <a href="<?php echo e(url('latest-updated', ['page' => $i])); ?>" data-page="<?php echo e($i); ?>"><?php echo e($i); ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="next">
                                        <a href="<?php echo e(url('latest-updated', ['page' => 2])); ?>" data-page="2">»</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-body'); ?>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>

    <script type="text/javascript">
        $("img.lazyload").lazyload();
        $(document).ready(function () {
            $(".my-rating").starRating({
                totalStars: 5,
                minRating: 1,
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('themes.manhwa18cc.layouts.full', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/truyenhaybl.com/resources/views/themes/manhwa18cc/pages/home.blade.php ENDPATH**/ ?>