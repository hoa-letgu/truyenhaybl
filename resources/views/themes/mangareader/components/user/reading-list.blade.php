<div id="main-content">
    <!--Begin: Section Manga list-->
    <section class="block_area block_area_fav">
        <div class="block_area-header">
            <div class="float-left bah-heading">
                <h2 class="cat-heading">{{ L::_('Reading List') }}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="fav-tabs mb-4">
            <ul class="nav nav-tabs pre-tabs pre-tabs-min">

                <li class="nav-item"><a href="{{ url('user.reading-list') }}"
                                        class="nav-link @if(!$type) active @endif">{{ L::_('All') }}</a></li>

                @foreach(readingList() as $reading_type => $reading_name)
                    <li class="nav-item">
                        <a href="{{ url('user.reading-list', null, ['type' => $reading_type]) }}"
                           class="nav-link @if($type == $reading_type) active @endif">{{ $reading_name }}</a>
                    </li>
                @endforeach

            </ul>
            <div class="item-order">
                <div class="bhs-item">
                    <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="bhsi-name">
                        @if(!($sort))
                            {{ L::_('Default') }}
                        @else
                            {{ sortName($sort) }}
                        @endif
                            <i class="fas fa-angle-down ml-2"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-model dropdown-menu-normal" aria-labelledby="ssc-list">
                        @if(!($sort))
                            <a class="dropdown-item added" href="{{ url('user.reading-list') }}">
                                {{ L::_('Default') }} <i class="fas fa-check ml-2"></i>
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ url('user.reading-list') }}">
                                {{ L::_('Default') }}
                            </a>
                        @endif
                        @foreach(sortType() as $sort_id => $sort_name)
                            @if($sort !== $sort_id)
                                <a class="dropdown-item "
                                   href="{{ url('user.reading-list', null, ['sort' => $sort_id])  }}">{{ $sort_name }}</a>
                            @else
                                <a class="dropdown-item added"
                                   href="{{ url('user.reading-list', null, ['sort' => $sort_id])  }}">{{ $sort_name }}
                                    <i class="fas fa-check ml-2"></i></a>
                            @endif
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="manga_list-sbs">
            <div class="mls-wrap">
                @foreach($list_reading as $manga)
                    <div class="item item-spc">

                        <div class="dr-fav">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                               class="btn btn-circle btn-light btn-fav"><i class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                                @foreach(readingList() as $reading_type => $reading_name)
                                    <a class="rl-item dropdown-item {{ ($reading_type == $manga->read_type ? 'added' : '') }}"
                                       data-type="{{ $reading_type }}"
                                       data-manga-id="{{ $manga->id }}"
                                       data-page="reading-list"
                                       href="javascript:(0);">{{ $reading_name }} @if($reading_type == $manga->read_type)
                                            <i class="fas fa-check ml-2"></i> @endif
                                    </a>
                                @endforeach
                                <a class="rl-item dropdown-item text-danger" href="javascript:(0);"
                                   data-manga-id="{{ $manga->id }}"
                                   data-type="0" data-page="reading-list">{{ L::_('Remove') }}</a>
                            </div>
                        </div>

                        <a class="manga-poster"
                           href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}">

                            <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                 data-src="{{ $manga->cover }}"
                                 class="manga-poster-img lazyload" alt="{{ $manga->name }}">
                        </a>
                        <div class="manga-detail">
                            <h3 class="manga-name">
                                <a href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"
                                   title="{{ $manga->name }}">{{ $manga->name }}</a>
                            </h3>
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

                                <div class="clearfix"></div>
                            </div>

                            <div class="fd-list">
                                @foreach(get_manga_data('chapters', $manga->id, []) as $chapter)
                                    <div class="fdl-item">
                                        <div class="chapter">
                                            <a href="{{ url('chapter', ['m_slug' => $manga->slug, 'c_slug' => $chapter->slug, 'c_id' => $chapter->id ]) }}">
                                                <i class="far fa-file-alt mr-2"></i>{{ $chapter->name }}</a>
                                        </div>
                                        <div class="release-time"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
                <div class="clearfix"></div>

            </div>
            <div class="pre-pagination mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg justify-content-center">
                        @if(!($paginate->current_page <= 1))
                            <?php
                            $prev_page = $paginate->current_page - 1;
                            ?>

                            <li class="page-item">
                                <a class="page-link" data-page="{{ $prev_page }}"
                                   href="{{ url('user.reading-list', null, ['page' => $prev_page, "type" => $type]) }}">‹</a>
                            </li>
                        @endif

                        @for($page_in_loop = 1; $page_in_loop <= $paginate->total_page; $page_in_loop++)
                            @if ($paginate->total_page > 3)
                                @if (( $page_in_loop >= $paginate->current_page - 2 && $page_in_loop <= $paginate->current_page )  || ( $page_in_loop <= $paginate->current_page + 2 && $page_in_loop >= $paginate->current_page))
                                    @if($page_in_loop == $paginate->current_page)
                                        <li class="page-item active">
                                            <a class="page-link" data-page="{{ $paginate->current_page }}"
                                               href="{{ url('user.reading-list', null, ['page' => $paginate->current_page, "type" => $type]) }}">{{ $paginate->current_page }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" data-page="{{ $page_in_loop }}"
                                               href="{{ url('user.reading-list', null, ['page' => $page_in_loop, "type" => $type]) }}">{{ $page_in_loop }}</a>
                                        </li>
                                    @endif
                                @endif
                            @else
                                @if($page_in_loop == $paginate->current_page)
                                    <li class="page-item active">
                                        <a data-page="{{ $paginate->current_page }}"
                                           class="page-link"
                                           href="{{ url('user.reading-list', null, ['page' => $paginate->current_page, "type" => $type]) }}">{{ $paginate->current_page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a data-page="{{ $page_in_loop }}"
                                           class="page-link"
                                           href="{{ url('user.reading-list', null, ['page' => $page_in_loop, "type" => $type]) }}">{{ $page_in_loop }}</a>
                                    </li>
                                @endif
                            @endif
                        @endfor


                        @if(!($paginate->total_page <= $paginate->current_page))
                            <?php
                            $next_page = $paginate->current_page + 1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" data-page="1"
                                   href="{{ url('user.reading-list', null, ['page' => $next_page, "type" => $type]) }}">›</a>
                            </li>
                        @endif
                    </ul>

                </nav>
            </div>
        </div>
    </section>
    <!--End: Section Manga list-->
    <div class="clearfix"></div>
</div>
