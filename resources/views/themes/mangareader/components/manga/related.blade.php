<section class="block_area block_area_sidebar block_area-realtime">
    <div class="block_area-header">
        <div class="float-left bah-heading">
            <h2 class="cat-heading">{{ L::_('You May Also Like') }}</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="block_area-content">
        <div class="cbox cbox-list cbox-realtime">
            <div class="featured-block-ul">
                <ul class="ulclear">
                    @foreach( (new \Models\Manga)->RelatedManga(6) as $manga)
                        <li class="item-top">
                            <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"
                               class="manga-poster">
                                <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                     data-src="{{ $manga->cover }}"
                                     class="manga-poster-img lazyload"
                                     alt="{{ $manga->name }}">
                            </a>
                            <div class="manga-detail">
                                <h3 class="manga-name">
                                    <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"
                                       title="{{ $manga->name }}">{{ $manga->name }}</a></h3>
                                <div class="fd-infor">
            <span class="fdi-item fdi-cate">

                    <?php
                $genres = array_slice(get_manga_data('genres', $manga->id, []), 0, 3);
                $total_genres = count($genres);
                $i = 1;
                ?>
                @foreach($genres as $key => $genre)
                    <a href="{{ url('genres', ['genres' => $genre->slug]) }}">{{ $genre->name }}</a>
                    @if(!($key + 1 >= $total_genres)),
                    @endif
                @endforeach

            </span>
                                    <div class="d-block">
                                        @foreach(array_slice(get_manga_data('chapters', $manga->id, []),0 , 2) as $chapter)
                                            <span class="fdi-item fdi-chapter">
                    <a href="{{ url('chapter', ['m_slug' => $manga->slug, 'c_slug' => $chapter->slug, 'c_id' => $chapter->id ]) }}"><i
                                class="far fa-file-alt mr-2"></i>{{ $chapter->name }}</a>
            </span>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>