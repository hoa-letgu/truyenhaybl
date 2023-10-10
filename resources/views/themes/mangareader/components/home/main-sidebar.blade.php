<div id="main-sidebar">
    <section class="block_area block_area_sidebar block_area-realtime">
        <div class="block_area-header">
            <div class="float-left bah-heading">
                <h2 class="cat-heading">{{ L::_('Most Viewed') }}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block_area-content">
            <div class="cbox cbox-list cbox-realtime">
                <div class="cbox-content">
                    <ul class="nav nav-pills nav-fill nav-tabs anw-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#chart-today">{{ L::_('Today') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#chart-week">{{ L::_('Week') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#chart-month">{{ L::_('Month') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="chart-today">
                            <div class="featured-block-ul featured-block-chart">
                                <ul class="ulclear">
                                    @foreach((new Models\Manga())->top_views('views_day', 10) as $manga)
                                    <?php $i = ($i ?? 0) + 1 ?>

                                    @if($i <= 3) <li class="item-top">
                                        @else
                                        <li>
                                            @endif
                                            <div class="ranking-number">
                                                @if($i <= 9) <span>0{{ $i }}</span>
                                                    @else
                                                    <span>{{ $i }}</span>
                                                    @endif
                                            </div>
                                            <a class="manga-poster" href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"><img alt="{{ $manga->name }}" class="manga-poster-img lazyload" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ $manga->cover }}"></a>
                                            <div class="manga-detail">
                                                <h3 class="manga-name">
                                                    <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}" title="T{{ $manga->name }}">{{ $manga->name }}</a></h3>
                                                <div class="fd-infor">
                                                    <span class="fdi-item">{{ $manga->type ?? L::_('Webtoon') }}</span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item fdi-cate">
                                                        <?php
                                                            $genres = array_slice(get_manga_data('genres', $manga->id, []), 0, 2);
                                                            $total_genres = count($genres);
                                                            ?>
                                                        @foreach($genres as $key => $genre)
                                                        <a href="{{ url('genres', ['genres' => $genre->slug]) }}">{{ $genre->name }}</a>
                                                        @if(!($key + 1 >= $total_genres)), @endif
                                                        @endforeach
                                                    </span>
                                                    <span class="fdi-item fdi-view">{{ $manga->views_day }} {{ L::_('views') }}</span>
                                                    <div class="d-block">
                                                        @if($chapters = get_manga_data('chapters', $manga->id))
                                                        <span class="fdi-item fdi-chapter">
                                                            <a href="{{ url('chapter', ['m_slug' => $manga->slug, "c_slug" => $chapters[0]->slug, "c_id" => $chapters[0]->id]) }}">
                                                                <i class="far fa-file-alt mr-2"></i>{{ $chapters[0]->name }}</a>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="tab-pane" id="chart-week">
                            <div class="featured-block-ul featured-block-chart">
                                <ul class="ulclear">
                                    <?php $i=0 ?>
                                    @foreach((new Models\Manga())->top_views('views_week', 10) as $manga)
                                    <?php $i = ($i >= 10 ? 0 : $i) + 1 ?>

                                    @if($i <= 3) <li class="item-top">
                                        @else
                                        <li>
                                            @endif
                                            <div class="ranking-number">
                                                @if($i <= 9) <span>0{{ $i }}</span>
                                                    @else
                                                    <span>{{ $i }}</span>
                                                    @endif
                                            </div>
                                            <a class="manga-poster" href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"><img alt="{{ $manga->name }}" class="manga-poster-img lazyload" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ $manga->cover }}"></a>
                                            <div class="manga-detail">
                                                <h3 class="manga-name">
                                                    <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}" title="T{{ $manga->name }}">{{ $manga->name }}</a></h3>
                                                <div class="fd-infor">
                                                    <span class="fdi-item">{{ $manga->type ?? L::_('Webtoon') }}</span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item fdi-cate">
                                                        <?php
                                                            $genres = array_slice(get_manga_data('genres', $manga->id, []), 0, 2);
                                                            $total_genres = count($genres);
                                                            ?>
                                                        @foreach($genres as $key => $genre)
                                                        <a href="{{ url('genres', ['genres' => $genre->slug]) }}">{{ $genre->name }}</a>
                                                        @if(!($key + 1 >= $total_genres)), @endif
                                                        @endforeach
                                                    </span>
                                                    <span class="fdi-item fdi-view">{{ $manga->views_week }} {{ L::_('views') }}</span>
                                                    <div class="d-block">
                                                        @if($chapters = get_manga_data('chapters', $manga->id))
                                                        <span class="fdi-item fdi-chapter">
                                                            <a href="{{ url('chapter', ['m_slug' => $manga->slug, "c_slug" => $chapters[0]->slug, "c_id" => $chapters[0]->id]) }}">
                                                                <i class="far fa-file-alt mr-2"></i>{{ $chapters[0]->name }}</a>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="tab-pane" id="chart-month">
                            <div class="featured-block-ul featured-block-chart">
                                <ul class="ulclear">
                                    <?php $i=0 ?>

                                    @foreach((new Models\Manga())->top_views('views_month', 10) as $manga)
                                    <?php $i = ($i >= 10 ? 0 : $i) + 1 ?>

                                    @if($i <= 3) <li class="item-top">
                                        @else
                                        <li>
                                            @endif
                                            <div class="ranking-number">
                                                @if($i <= 9) <span>0{{ $i }}</span>
                                                    @else
                                                    <span>{{ $i }}</span>
                                                    @endif
                                            </div>
                                            <a class="manga-poster" href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"><img alt="{{ $manga->name }}" class="manga-poster-img lazyload" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ $manga->cover }}"></a>
                                            <div class="manga-detail">
                                                <h3 class="manga-name">
                                                    <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}" title="T{{ $manga->name }}">{{ $manga->name }}</a></h3>
                                                <div class="fd-infor">
                                                    <span class="fdi-item">{{ $manga->type ?? L::_('Webtoon') }}</span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item fdi-cate">
                                                        <?php
                                                            $genres = array_slice(get_manga_data('genres', $manga->id, []), 0, 2);
                                                            $total_genres = count($genres);
                                                            ?>
                                                        @foreach($genres as $key => $genre)
                                                        <a href="{{ url('genres', ['genres' => $genre->slug]) }}">{{ $genre->name }}</a>
                                                        @if(!($key + 1 >= $total_genres)), @endif
                                                        @endforeach
                                                    </span>
                                                    <span class="fdi-item fdi-view">{{ $manga->views_month }} {{ L::_('views') }}</span>
                                                    <div class="d-block">
                                                        @if($chapters = get_manga_data('chapters', $manga->id))
                                                        <span class="fdi-item fdi-chapter">
                                                            <a href="{{ url('chapter', ['m_slug' => $manga->slug, "c_slug" => $chapters[0]->slug, "c_id" => $chapters[0]->id]) }}">
                                                                <i class="far fa-file-alt mr-2"></i>{{ $chapters[0]->name }}</a>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
</div>
