<div id="manga-trending">
    <div class="container">
        <section class="block_area block_area_featured mb-0">
            <div class="block_area-header">
                <div class="bah-heading">
                    <h2 class="cat-heading">Trending</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="block_area-content featured-03">
                <div class="trending-list" id="trending-home">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach((new Models\Manga())->trending_manga(10) as $manga)
                                <div class="swiper-slide">
                                    <div class="item">
                                        <div class="manga-poster">
                                            <a class="link-mask"
                                               href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"></a>
{{--                                            <span class="tick tick-item tick-lang">EN/JA</span>--}}
                                            <div class="mp-desc">
                                                <p class="alias-name mb-2"><strong>{{ $manga->name }}</strong></p>
                                                <p><i class="fas fa-star mr-2"></i>N/A</p>
                                                <p><i class="fas fa-eye mr-2"></i>{{ $manga->views }}</p>
                                                <p>
                                                    <?php $chapters = get_manga_data('chapters', $manga->id); ?>
                                                    @if($chapters)
                                                    <a href="{{ url('chapter', ['m_slug' => $manga->slug, "c_slug" => $chapters[0]->slug, "c_id" => $chapters[0]->id]) }}">
                                                        <i class="far fa-file-alt mr-2"></i><strong>{{ $chapters[0]->name }}</strong></a>
                                                    @endif
                                                </p>

                                                <div class="mpd-buttons">
                                                    <a class="btn btn-primary btn-sm btn-block"
                                                       href="{{ url('read_first', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}">
                                                        <i class="fas fa-glasses mr-2"></i>{{ L::_('Read Now') }}</a>
                                                    <a class="btn btn-light btn-sm btn-block"
                                                       href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"><i
                                                                class="fas fa-info-circle mr-2"></i>{{ L::_('Info') }}</a>
                                                </div>
                                            </div>
                                            <img alt="{{ $manga->name }}" class="manga-poster-img lazyload"
                                                 src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                                 data-src="{{ $manga->cover }}">
                                        </div>
                                        <div class="number">
                                            <?php $i = ($i ?? 0) + 1 ?>

                                            @if($i <= 9)
                                                <span>0{{ $i }}</span>
                                            @else
                                                <span>{{ $i }}</span>
                                            @endif
                                            <div class="anime-name">
                                                {{ $manga->name }}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="trending-navi">
                        <div class="navi-next">
                            <i class="fas fa-angle-right"></i>
                        </div>
                        <div class="navi-prev">
                            <i class="fas fa-angle-left"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>