@extends('themes.mangareader.layouts.full')
@section('title', $seo_title . ' - ' . getConf('meta')['site_name'])

@section('content')
<div class="prebreadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach($breadcrumb as $breadcrumb_item)
                <li class="breadcrumb-item" {{ (isset($breadcrumb_item->active) ? 'active' : '') }}>
                    @if($breadcrumb_item->url)
                    <a href="{{ $breadcrumb_item->url }}">{{ $breadcrumb_item->name }}</a>
                    @else
                    {{ $breadcrumb_item->name }}
                    @endif
                </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
<div id="main-wrapper" class="page-layout page-category">
    <div class="container">
        <div id="mw-2col">
            
            <!--Begin: main-content-->
            <div id="main-content">
                <!--Begin: Section Manga list-->
              

                <section class="block_area block_area_category">
                    <div class="block_area-header">
                        <div class="bah-heading float-left">
                            <h2 class="cat-heading">{{ $heading_title }}</h2>
                        </div>
                        @if($sort !== false)
                        <div class="cate-sort float-right">
                            <div class="cs-item">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="btn btn-sm btn-sort">
                                    <span class="mr-2">{{ L::_('Sort') }}:</span>
                                    @if(!($sort))
                                    {{ L::_('Default') }}
                                    @else
                                    {{ sortName($sort) }}
                                    @endif
                                    <i class="fas fa-angle-down ml-2"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                                    @if(!($sort))
                                    <a class="dropdown-item added" href="{{ url($url) }}">
                                        {{ L::_('Default') }} <i class="fas fa-check ml-2"></i>
                                    </a>
                                    @else
                                    <a class="dropdown-item" href="{{ url($url) }}">
                                        {{ L::_('Default') }}
                                    </a>
                                    @endif
                                    @foreach(sortType() as $sort_id => $sort_name)
                                    @if($sort !== $sort_id)
                                    <a class="dropdown-item " href="{{ url($url, null, ['sort' => $sort_id])  }}">{{
                                        $sort_name }}</a>
                                    @else
                                    <a class="dropdown-item added"
                                        href="{{ url($url, null, ['sort' => $sort_id])  }}">{{ $sort_name }}
                                        <i class="fas fa-check ml-2"></i></a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                    <div class="manga_list-sbs">
                        <div class="mls-wrap">
                            @foreach($mangas as $manga)
                            <div class="item item-spc">

                                <a class="manga-poster"
                                    href="{{ url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                        data-src="{{ $manga->cover }}" class="manga-poster-img lazyload"
                                        alt="{{ $manga->name }}">
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
                                            <a href="{{ url('genres', ['genres' => $genre->slug]) }}">{{ $genre->name
                                                }}</a>
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
                                                <a
                                                    href="{{ url('chapter', ['m_slug' => $manga->slug, 'c_slug' => $chapter->slug, 'c_id' => $chapter->id ]) }}">
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
                                    @if(!($paginate->current_page <= 1)) <?php $prev_page=$paginate->current_page - 1;
                                        ?>

                                        <li class="page-item">
                                            <a class="page-link" data-page="{{ $prev_page }}"
                                                href="{{ url($url, ['page' => $prev_page], $params) }}">‹</a>
                                        </li>
                                        @endif

                                        @for($page_in_loop = 1; $page_in_loop <= $paginate->total_page; $page_in_loop++)
                                            @if ($paginate->total_page > 3)
                                            @if (( $page_in_loop >= $paginate->current_page - 2 && $page_in_loop <=
                                                $paginate->current_page ) || ( $page_in_loop <= $paginate->current_page
                                                    + 2 && $page_in_loop >= $paginate->current_page))
                                                    @if($page_in_loop == $paginate->current_page)
                                                    <li class="page-item active">
                                                        <a class="page-link" data-page="{{ $paginate->current_page }}"
                                                            href="{{ url($url,['page' => $paginate->current_page],$params) }}">{{
                                                            $paginate->current_page }}</a>
                                                    </li>
                                                    @else
                                                    <li class="page-item">
                                                        <a class="page-link" data-page="{{ $page_in_loop }}"
                                                            href="{{ url($url, ['page' => $page_in_loop], $params) }}">{{
                                                            $page_in_loop }}</a>
                                                    </li>
                                                    @endif
                                                    @endif
                                                    @else
                                                    @if($page_in_loop == $paginate->current_page)
                                                    <li class="page-item active">
                                                        <a data-page="{{ $paginate->current_page }}" class="page-link"
                                                            href="{{ url($url, ['page' => $paginate->current_page], $params) }}">{{
                                                            $paginate->current_page }}</a>
                                                    </li>
                                                    @else
                                                    <li class="page-item">
                                                        <a data-page="{{ $page_in_loop }}" class="page-link"
                                                            href="{{ url($url, ['page' => $page_in_loop], $params) }}">{{
                                                            $page_in_loop }}</a>
                                                    </li>
                                                    @endif
                                                    @endif
                                                    @endfor


                                                    @if(!($paginate->total_page <= $paginate->current_page))
                                                        <?php
                                            $next_page = $paginate->current_page + 1;
                                            ?>
                                                        <li class="page-item">
                                                            <a class="page-link" data-page="{{ $next_page }}"
                                                                href="{{ url($url, ['page' => $next_page], $params) }}">›</a>
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
            <!--/End: main-content-->
            <!--Begin: main-sidebar-->
            <div id="main-sidebar">
                @include('themes.mangareader.components.category-block')
            </div>
            <!--/End: main-sidebar-->
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@stop

@section('modal')
@stop

@section('js-body')
@stop