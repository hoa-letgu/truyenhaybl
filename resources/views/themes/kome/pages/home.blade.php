@extends('themes.kome.layouts.full')
@section('title', getConf('meta')['home_title'])
@section('description', getConf('meta')['home_description'])
@section('url', url('home'))

@include('ads.banner-ngang')
@include('ads.banner-sidebar')

@section("ping-list")
    <div class="wrap-content-part">
        <div class="header-content-part pl-sm-3 pr-sm-3 pl-md-3 pr-md-3 pl-lg-2 pr-lg-2">
            <h2 class="title">
                <span class="ico-flame-sharp icon-2x icon-title"></span>{{ L::_("Trending") }}
            </h2>
            <a class="more" href="{{ url('manga_list') }}"> {{ L::_("View more") }} »</a>
        </div>
        <div class="body-content-part">
            <div class="row">
                @foreach((new Models\Manga())->pin_manga(getConf('site')['total_pin']) as $key => $manga)
                    @include("themes.kome.template.thumb-item-flow")
                @endforeach
            </div>
        </div>
    </div>
@stop

@section("newupdate-list")
    <div class="wrap-content-part">
        <div class="header-content-part pl-sm-3 pr-sm-3 pl-md-3 pr-md-3 pl-lg-2 pr-lg-2">
            <h2 class="title">{{ L::_("New Update") }}</h2>
            <a class="more" href="{{ url('manga_list') }}"> {{ L::_("View more") }} »</a></div>
        <div class="body-content-part">
            <div class="row">
                @foreach((new Models\Manga())->new_update($page, getConf('site')['newupdate_home']) as $manga)
                    @include("themes.kome.template.thumb-item-flow")
                @endforeach
            </div>
            <div class="list-pager">
                <div class="pager">
                    <a href="{{ url('manga_list') }}"
                       class="centertextblock1 btn-top11 btn-primary btn_theodoitruyen shadow-none">{{ L::_("View more") }}</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="fed-part-case" id="main-content">
        @yield("ping-list")

        @yield("newupdate-list")
    </div>

@stop

@section('js-body')

@stop