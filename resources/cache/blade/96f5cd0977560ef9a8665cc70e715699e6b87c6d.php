<div class="search-manga wleft tcenter" style="display: none;">
    <div id="searchpc" class="header-search" ng-controller="livesearch">
        <form action="<?php echo e(url("search")); ?>" method="get">
            <input name="keyword" type="text" ng-model="search_query" ng-keyup="fetchData()" placeholder="Search..."
                   autocomplete="off">
            <button type="submit">
                <i class="icofont-search-1"></i>
            </button>
        </form>
        <div class="live-search-result live-pc-result" style="display: none;">
            <ul ng-if="searchData">
                <li ng-repeat="data in searchData">
                    <a class="wleft" ng-click="readManga(data.id,data.slug)" ng-bind-html="data.name"
                       href="javascript:(0)"></a>
                </li>
            </ul>
            <div ng-if="loading" class="search-loading">
                <img src="/manhwa18cc/images/images-search-loading.gif" alt="loading...">
            </div>
        </div>
    </div>
</div>

<div class="header-manga pc-header wleft">
    <div class="header-top wleft">
        <div class="centernav">
            <div class="logo">
                <a title="Read Webtoons and Korean Manhwa in English for Free" href="<?php echo e(url("home")); ?>">
                    <img src="/manhwa18cc/images/images-manhwa18.png"
                         alt="Read Webtoons and Korean Manhwa in English for Free">
                </a>
            </div>
            <div class="top-menu">
                <div class="left-menu">
                    <ul>
                        <li class="menu-item">
                            <a href="<?php echo e(url("home")); ?>" title="Read Webtoons and Korean Manhwa in English for Free">
                                <i class="icofont-home"></i> <?php echo e(L::_("HOME")); ?>

                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo e(url("latest-updated")); ?>"
                               title="Browser all Webtoons and Korean Manhwa"><?php echo e(L::_("All Webtoons")); ?></a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo e(url("search", null, ['keyword' => 'raw'])); ?>"
                               title="Premium Webtoons Raw, Manhwa Raw"><?php echo e(L::_("Raw")); ?></a>
                        </li>
                    </ul>
                </div>
                <div class="right-menu">
                    <a class="open-search-main-menu search-ico" href="javascript:(0)">
                        <i class="icofont-search-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom wleft">
        <div class="centernav">
            <ul>
                <li>
                    <a href="<?php echo e(url("completed")); ?>"
                       title="Completed Webtoons, Korean Manhwa"><?php echo e(L::_("Completed")); ?></a>
                </li>
                <li class="dropdownmenu">
                    <a href="#" title="Manga List - Genres: All">
                        <?php echo e(L::_("Genres")); ?> <i class="icofont-caret-right"></i>
                    </a>
                </li>
                <div class="sub-menu" style="display: none;">
                    <ul>
                        <?php $__currentLoopData = Models\Taxonomy::GetListGenres(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(url('genres', ['genres' => $genre->slug])); ?>"
                                   title="<?php echo e($genre->name); ?>"><?php echo e($genre->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </ul>
            <?php echo $__env->make("themes.manhwa18cc.components.user-block", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>

<div class="header-manga mb-header wleft">
    <div class="top-header">
        <div class="menu-ico">
            <i class="icofont-navigation-menu open-menu"></i>
            <i class="icofont-close close-menu" style="display: none;"></i>
        </div>
        <div class="logo">
            <a title="Read Webtoons and Korean Manhwa in English for Free" href="<?php echo e(url("home")); ?>">
                <img src="/manhwa18cc/images/images-manhwa18.png"
                     alt="Read Webtoons and Korean Manhwa in English for Free">
            </a>
        </div>
        <div class="search-ico">
            <i class="icofont-search-1 open-search" style="display: block;"></i>
            <i class="icofont-close close-search" style="display: none;"></i>
        </div>
    </div>
    <div class="under-header">
        <div class="header-menu" style="display: none;">
            <ul>
                <li>
                    <a href="<?php echo e(url('home')); ?>" title="Read Webtoons and Korean Manhwa in English for Free"><i
                                class="icofont-home"></i> <?php echo e(L::_("Home")); ?></a>
                </li>
                <li>
                    <a href="<?php echo e(url("latest-updated")); ?>"
                       title="Browser all Webtoons and Korean Manhwa"><?php echo e(L::_("All Webtoons")); ?></a>
                </li>
                <li>
                    <a href="<?php echo e(url("search", null, ['keyword' => 'raw'])); ?>" title="Premium Webtoons Raw, Manhwa Raw">Raw</a>
                </li>
                <li class="dropdownmenumb">
                    <a href="#" title="Manga List - Genres: All">
                        <?php echo e(L::_("Genres")); ?> <i class="icofont-caret-right"></i>
                    </a>
                </li>
                <div class="sub-menumb" style="display: none;">
                    <ul>
                        <?php $__currentLoopData = Models\Taxonomy::GetListGenres(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(url('genres', ['genres' => $genre->slug])); ?>" title="<?php echo e($genre->name); ?>"><i
                                            class="icofont-caret-right"></i><?php echo e($genre->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>
                <li>
                    <a href="<?php echo e(url("completed")); ?>"
                       title="Completed Webtoons, Korean Manhwa"><?php echo e(L::_("Completed")); ?></a>
                </li>
            </ul>
            <?php echo $__env->make("themes.manhwa18cc.components.user-block", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/truyenhaybl.com/resources/views/themes/manhwa18cc/components/header.blade.php ENDPATH**/ ?>