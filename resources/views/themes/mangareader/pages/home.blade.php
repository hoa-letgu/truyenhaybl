@extends('themes.mangareader.layouts.full')
@section('title', getConf('meta')['home_title'])
@section('description', getConf('meta')['home_description'])
@section('url', url('home'))

@section('header-class', 'home-header')
@section('content')

    @include('themes.mangareader.components.home.deslide')
    @include('themes.mangareader.components.home.text-share')
    @include('themes.mangareader.components.home.trending')


    @include('themes.mangareader.components.home.category')

    <div id="manga-continue"></div>
    @include('themes.mangareader.components.home.recommended')
    @include('themes.mangareader.components.home.main-wrapper')
    <div class="ads-content">
    </div>

@stop

@section('js-body')
    <script src="{{ asset('mangareader/js/swiper-bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('mangareader/js/swiper-home.js') }}"></script>
    <link href="{{ asset('mangareader/css/swiper-home.css') }}" rel="stylesheet"/>

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                getScript('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61310d692ddb96c6')
            }, 2000);
        });
    </script>
@stop