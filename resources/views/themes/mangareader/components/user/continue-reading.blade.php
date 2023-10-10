<div id="main-content">
    <!--Begin: Section Manga list-->
    <section class="block_area block_area_continue">
        <div class="block_area-header block_area-header-tabs">
            <div class="float-left bah-heading">
                <h2 class="cat-heading">{{ L::_('Continue Reading') }}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="manga_list-continue">
            <div class="mlc-wrap">
                @foreach($list_reading as $manga)
                <div class="item">
                    <div class="ctn-item">
                        <div class="ctn-detail">
                            <div class="manga-poster">
                                <a class="link-mask" href="{{ url('manga', ['m_id' => $manga->id, 'm_slug' => $manga->slug]) }}"></a>
                                <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                     data-src="{{ $manga->cover }}"
                                     class="manga-poster-img lazyload" alt="{{ $manga->name }}">
                            </div>
                            <div class="manga-detail">
                                <div class="dr-remove">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                       class="btn btn-sm btn-remove"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-model dmm-topright"
                                         aria-labelledby="ssc-list">
                                        <a href="javascript:(0);" data-id="{{ $manga->id }}"
                                           class="dropdown-item text-danger btn-remove-cr">Remove</a>
                                    </div>
                                </div>
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
                                        @if(!($key + 1 >= $total_genres)),
                                        @endif
                                    @endforeach
                                </div>
                                <a href="{{ url('chapter', ['m_slug' => $manga->slug, 'c_slug' => $manga->chapter_slug , 'c_id' => $manga->chapter_id]) }}"
                                   title="{{ $manga->name }}" class="reading-load">
                                    <div class="rl-loaded" style="width: 100%;"></div>
                                    <div class="rl-text">
                                        <span>Đọc tiếp </span>{{ $manga->chapter_name }}
                                    </div>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="loading-absolute bg-white" id="cr-loading-{{ $manga->id }}" style="display: none">
                            <div class="loading">
                                <div class="span1"></div>
                                <div class="span2"></div>
                                <div class="span3"></div>
                            </div>
                        </div>
                    </div>
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
                                   href="{{ url('user.continue-reading', null, ['page' => $prev_page]) }}">‹</a>
                            </li>
                        @endif

                        @for($page_in_loop = 1; $page_in_loop <= $paginate->total_page; $page_in_loop++)
                            @if ($paginate->total_page > 3)
                                @if (( $page_in_loop >= $paginate->current_page - 2 && $page_in_loop <= $paginate->current_page )  || ( $page_in_loop <= $paginate->current_page + 2 && $page_in_loop >= $paginate->current_page))
                                    @if($page_in_loop == $paginate->current_page)
                                        <li class="page-item active">
                                            <a class="page-link" data-page="{{ $paginate->current_page }}"
                                               href="{{ url('user.continue-reading', null, ['page' => $paginate->current_page]) }}">{{ $paginate->current_page }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" data-page="{{ $page_in_loop }}"
                                               href="{{ url('user.continue-reading', null, ['page' => $page_in_loop]) }}">{{ $page_in_loop }}</a>
                                        </li>
                                    @endif
                                @endif
                            @else
                                @if($page_in_loop == $paginate->current_page)
                                    <li class="page-item active">
                                        <a data-page="{{ $paginate->current_page }}"
                                           class="page-link" href="{{ url('user.continue-reading', null, ['page' => $paginate->current_page]) }}">{{ $paginate->current_page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a  data-page="{{ $page_in_loop }}"
                                           class="page-link" href="{{ url('user.continue-reading', null, ['page' => $page_in_loop]) }}">{{ $page_in_loop }}</a>
                                    </li>
                                @endif
                            @endif
                        @endfor


                        @if(!($paginate->total_page <= $paginate->current_page))
                            <?php
                            $next_page = $paginate->current_page + 1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" data-page="{{ $next_page }}" href="{{ url('user.continue-reading', null, ['page' => $next_page]) }}">›</a>
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