<div id="manga-featured">
    <div class="container">
        <section class="block_area block_area_featured">
            <div class="block_area-header">
                <div class="bah-heading">
                    <h2 class="cat-heading">{{ L::_('Recommended') }}</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="block_area-content">
                <div class="featured-list" id="featured-03">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            $Cache = Services\Cache::load();
                            $CachedString = $Cache->getItem('recommended.home');
                            if(!$CachedString->isHit()){
                                $data = (new Models\Manga())->recommended(12);
                                $CachedString->set($data)->expiresAfter(500);
                                $Cache->save($CachedString);
                            }

                            ?>
                            @foreach($CachedString->get() as $manga)
                            <div class="swiper-slide">
                                <div class="mg-item-basic">
                                    <div class="manga-poster">
                                        <a class="link-mask"
                                           href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"></a>
                                        @if((strtotime('now') - strtotime($manga->created_at)) < 60 * 60 *24)
                                        <span class="tick tick-item tick-lang">{{ L::_('New') }}</span>
                                        @endif
                                        <div class="mp-desc">
                                            <p class="alias-name mb-2"><strong>{{ $manga->name }}</strong>
                                            </p>
                                            <p><i class="fas fa-eye mr-2"></i>{{ $manga->views }}</p>
                                            @if($chapters = get_manga_data('chapters', $manga->id))
                                                <p>
                                                    <a href="{{ url('chapter', ['m_slug' => $manga->slug, "c_slug" => $chapters[0]->slug, "c_id" => $chapters[0]->id]) }}">
                                                        <i class="far fa-file-alt mr-2"></i><strong>{{ $chapters[0]->name }}</strong></a>
                                                </p>
                                            @endif
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
                                    <div class="manga-detail">
                                        <h3 class="manga-name">
                                            <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"
                                               title="{{ $manga->name }}">{{ $manga->name }}</a>
                                        </h3>
                                        <div class="fd-infor">
                                            <?php
                                            $genres = array_slice(get_manga_data('genres', $manga->id, []), 0, 2);
                                            $total_genres = count($genres);
                                            $i = 1;
                                            ?>
                                            @foreach($genres as $key => $genre)
                                                <a href="{{ url('genres', ['genres' => $genre->slug]) }}">{{ $genre->name }}</a>
                                                @if(!($key + 1 >= $total_genres)), @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="featured-navi">
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