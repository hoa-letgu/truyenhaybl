@extends('themes.kome.layouts.full')
@section('title', $seo_title . ' - ' . getConf('meta')['site_name'])
@include('ads.banner-ngang')
@include('ads.banner-sidebar')

@section('content')
    <div class="fed-part-case" id="main-content">
        <div class="wrap-content-part list-manga">
            <div class="header-content-part pl-sm-3 pr-sm-3 pl-md-3 pr-md-3 pl-lg-2 pr-lg-2">
                <div class="title">{{ $heading_title }}</div>
            </div>
            <div class="body-content-part">
                <div class="row">
                    @foreach($mangas as $manga)
                        @include("themes.kome.template.thumb-item-flow")
                    @endforeach
                </div>
                <li class="list-pager">
                    <ul class="pager">

                        @if($paginate->current_page <= 1)
                            <li class="prev disabled"><a href="#">«</a></li>
                        @else
                            <li class="prev">
                                <a href="{{ url(null, ['page' => $paginate->current_page - 1], $params) }}"
                                   data-page="{{ $paginate->current_page - 1 }}">«</a>
                            </li>
                        @endif

                        @if($paginate->current_page - 1 <= 0)
                            <li class="active">
                                <a href="{{ url() }}"
                                   data-page="{{ $paginate->current_page }}">{{ $paginate->current_page }}</a>
                            </li>
                        @else
                            <li class="">
                                <a href="{{ url(null, ['page' => $paginate->current_page - 1], $params) }}"
                                   data-page="{{ $paginate->current_page - 1 }}">{{ $paginate->current_page - 1 }}</a>
                            </li>
                            <li class="active">
                                <a href="{{ url(null, ['page' => $paginate->current_page], $params) }}"
                                   data-page="{{ $paginate->current_page }}">{{ $paginate->current_page }}</a>
                            </li>
                        @endif
                        <?php
                        $next_pages = [1, 2, 3];
                        ?>
                        @foreach($next_pages as $pagenext)
                            @if($paginate->current_page + $pagenext <=$paginate->total_page)
                                <li>
                                    <a href="{{ url(null, ['page' => $paginate->current_page + $pagenext], $params) }}"
                                       data-page="{{ $paginate->current_page + $pagenext  }}">{{ $paginate->current_page + $pagenext  }}</a>
                                </li>
                            @endif
                        @endforeach


                        @if($paginate->current_page < $paginate->total_page)
                            <li class="next">
                                <a href="{{ url(null, ['page' => $paginate->current_page + 1], $params) }}"
                                   data-page="{{ $paginate->current_page + 1 }}">»</a>
                            </li>
                        @else
                            <li class="next disabled">
                                <a href="#">»</a>
                            </li>
                        @endif


                    </ul>
                </li>
            </div>
        </div>
    </div>
@stop

