<div id="main-wrapper" class="page-layout page-read page-read-hoz">
    <div class="container">
        <div class="container-reader-hoz">
            <div id="divslide">
                <div class="divslide-wrapper" data-page-size="1">
                    @foreach($chapter_data->content as $key => $image)
                    <div class="ds-item">
                        <div class="ds-image {{ isset($image->shuffled) ? " shuffled" : '' }}"
                            data-url="{{ $image->src ?? $image }}">
                            <div class="card-loading">
                                <div class="c-l-area">
                                    <div class="paper-loading"></div>
                                    <p class="mb-0">Loading...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="ds-item" style="display: none">
                    <div class="ds-image">
                        <div class="sc-btn" id="hoz-btn-next">
                            <div class="block" id="text-next"></div>
                            <button onclick="nextChapterVolume()" class="btn btn-primary">{{ L::_('Read now')
                                }}</button>
                        </div>
                        <div class="sc-rating">
                            <div class="sc-dt-rate" id="vote-info"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navi-buttons hoz-controls hoz-controls-ltr" style="display: none;">
                <div class="nabu-page">
                    <span>
                        <span class="hoz-current-index"></span> / <span class="hoz-total-image"></span>
                    </span>
                </div>
                <a onclick="hozNextImage()" href="javascript:void(0)" class="nabu nabu-right hoz-next">
                    <div class="navi-button navi-button-next">
                        <i class="fas fa-angle-right"></i>
                        <span>Next</span>
                    </div>
                </a>
                <a onclick="hozPrevImage()" href="javascript:void(0)" class="nabu nabu-left hoz-prev">
                    <div class="navi-button navi-button-prev">
                        <i class="fas fa-angle-left"></i>
                        <span>Prev</span>
                    </div>
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="navi-buttons hoz-controls hoz-controls-rtl">
                <div class="nabu-page">
                    <span>
                        <span class="hoz-current-index"></span> / <span class="hoz-total-image"></span>
                    </span>
                </div>
                <a onclick="hozNextImage()" href="javascript:void(0)" class="nabu nabu-left hoz-next">
                    <div class="navi-button navi-button-prev">
                        <i class="fas fa-angle-left"></i>
                        <span>Next</span>
                    </div>
                </a>
                <a onclick="hozPrevImage()" href="javascript:void(0)" class="nabu nabu-right hoz-prev">
                    <div class="navi-button navi-button-next">
                        <i class="fas fa-angle-right"></i>
                        <span>Prev</span>
                    </div>
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="photo-navigation hoz-controls hoz-controls-ltr" style="display: none;">
                <div class="photo-button photo-button-next hoz-next-hide" onclick="hozNextImage()"></div>
                <div class="photo-button photo-button-prev" onclick="hozPrevImage()"></div>
            </div>
            <div class="photo-navigation hoz-controls hoz-controls-rtl">
                <div class="photo-button photo-button-prev hoz-next-hide" onclick="hozNextImage()"></div>
                <div class="photo-button photo-button-next" onclick="hozPrevImage()"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>