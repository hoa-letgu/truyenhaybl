<div class="deslide-wrap">
    <div class="container">
        <div id="slider">
            <div class="swiper-wrapper">
                @foreach((new Models\Manga())->pin_manga(6) as $key => $manga)
                <div class="swiper-slide {{ ($key == 0 ? 'swiper-slide-active': '') }}">
                    <div class="deslide-item">
                        <a class="deslide-cover" href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}">
                            <img alt="{{ $manga->name }}"
                                 class="manga-poster-img lazyload"
                                 src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ $manga->cover }}">
                        </a>
                        <div class="deslide-poster">
                            <a class="manga-poster" href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}">
                                <img alt="{{ $manga->name }}"
                                     class="manga-poster-img lazyload"
                                     src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ $manga->cover }}"></a>
                        </div>
                        <div class="deslide-item-content">
                            <div class="desi-sub-text">
                                @if($chapters = get_manga_data('chapters', $manga->id))
                                    {{ str_replace('Chapter ', 'Chương: ', $chapters[0]->name) }}
                                @endif
                            </div>
                            <div class="desi-head-title">
                                <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}" title="{{ $manga->name }}">{{ $manga->name }}</a>
                            </div>
                            <div class="sc-detail">
                                <div class="scd-item mb-3">
                                    {{ limit_text($manga->description, 300) }}
                                </div>
                                <div class="scd-item scd-genres">

                                    @foreach(get_manga_data('genres', $manga->id, []) as $genre)
                                    <span>{{ $genre->name }}</span>
                                    @endforeach

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="desi-buttons">
                                <a class="btn btn-slide-read mr-2" href="{{ url('read_first', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}">{{ L::_('Read Now') }}</a> <a
                                        class="btn btn-slide-info" href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}">{{ L::_('View Info') }}</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-navigation">
                <div class="swiper-button swiper-button-next">
                    <i class="fas fa-angle-right"></i>
                </div>
                <div class="swiper-button swiper-button-prev">
                    <i class="fas fa-angle-left"></i>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>