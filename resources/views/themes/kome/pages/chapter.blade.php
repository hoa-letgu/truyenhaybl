@extends('themes.kome.layouts.full')
<?php
include(ROOT_PATH . '/resources/views/includes/chapter.php');

$nextchap = null;
$pevchap = null;
$chapters = \Models\Chapter::ChapterListByID($manga->id);

foreach ($chapters as $key => $chap){
  if($chap->id === $chapter->id){
      if(isset($chapters[$key + 1])){
          $pevchap = $chapters[$key + 1];
      }

      if(isset($chapters[$key - 1])){
          $nextchap = $chapters[$key - 1];
      }
  }
}

?>

@section('title', $metaConf['chapter_title'])
@section('description', $metaConf['chapter_description'])

@section('url', $chapter_url)
@section('image', $manga->cover)

@include('ads.banner-ngang')
@include('ads.banner-sidebar')

@section("head-css")
    <link href="/kome/assets/css/chapter.css" rel="stylesheet" type="text/css"/>
@stop

@section("chapter-breadcrumb")
    <nav class="chapter-breadcrumb" aria-label="breadcrumb">
        <ol
            class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem"><a title="Home" href="{{ url("home") }}"
                                                         itemprop="item">
                    <span itemprop="name">{{ L::_("Home") }}</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem">
                <a title="{{ $manga->name }}" href="{{ $manga_url }}" itemprop="item">
                    <span itemprop="name">{{ $manga->name }}</span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem">
                <a title="{{ $manga->name }} {{ $chapter->name }}"
                   href="{{ $chapter_url }}" style="color: #ffffff94;" itemprop="item">
                    <span itemprop="name">{{ $chapter->name }}</span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        </ol>
    </nav>
@stop

@section("wrap_header")
    <div class="wrap_header">
        <h1 class="tentruyen">
            <a title="{{ $manga->name }}" href="{{ $manga_url }}">{{ $manga->name }}</a>
            <a class="font-weight-normal" title="{{ $manga->name }} {{ $chapter->name }}"
               href="{{ $chapter_url }}">{{ $chapter->name }}</a>
        </h1>
        <p>{{ L::_("Updated On") }} : {{ date('Y-m-d', strtotime($chapter->last_update)) }}</p>
        <div style="margin:20px auto;">
            <button type="button" style="margin-right: 5px" class="btn btn-warning shadow-none" id="btnbaoloi"
                    data-toggle="modal" data-target="#baoloi">
                <i class="ico-warning"></i>{{ L::_("Error Report") }}
            </button>
            <button type="button" class="btn btn-info shadow-none" id="btntheodoi" action="bookmark">
                <i class="ico-heart"></i>{{ L::_("Bookmark") }}
            </button>
        </div>
    </div>
@stop

@section("wrap_navi")
    <div class="wrap_navi">
        <div class="flexRow mt-4 chapter_select">

            <a title="{{ ($pevchap->name ?? '') }}" class="changeChap prev"
               href="{{ chapter_url($manga, $pevchap) }}"><span class="ico-angle-double-left"></span>
            </a>

            <div class="px-2 flex1 select-chapter">
                <select class="form-control chapter-select" onchange="window.location=this.value;">
                    @foreach($chapters as $chap)
                    <option data-id="{{ $chap->id }}" value="{{ chapter_url($manga, $chap) }}"
                            @if($chap->id==$chapter->id) selected="" @endif>
                        {{ $chap->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <a title="{{ ($nextchap->name ?? '') }}" class="changeChap  next"
               href="{{ chapter_url($manga, $nextchap) }}"><span
                        class="ico-angle-double-right"></span></a>
        </div>
    </div>
@stop

@section("content")
    <script>
        var manga_id = {{ $manga->id }}, chapter_id = {{ $chapter->id }}, chapter_name = '{{ $chapter->name }}'
    </script>

    <div class="fed-part-case" id="main-content">
        <main>
            @yield("chapter-breadcrumb")

            @yield("wrap_header")

            @yield("wrap_navi")

            <div class="chapcontent" id="chapcontent">
                <div class="content-chap-image" id="content_chap">
                    <div class="fed-part-case">
                        <div id="lst_content" class="lst_image text-center">
                            @include("themes.kome.components.chapter.vertical-image-list")
                        </div>
                    </div>
                    <br class="clear"></div>
            </div>

            @yield("wrap_navi")

            @include("themes.kome.components.discus-comment")

            <div class="modal fade" id="baoloi">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"><h4 class="modal-title" id="myModalLabel">{{ L::_("Report Chapter") }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" role="form">
                                <textarea class="txtbaoloi" cols="40" id="motabaoloi"
                                          placeholder="Write in the error description here ..."></textarea>
                            </form>
                            <p style="margin:20px 0;">
                                <button class="btn baoloibutton" style="width:150px;margin:0 auto;">{{ L::_("Send report") }}<i
                                            class="fa ico-send"></i></button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
@stop

@section("body-js")
    <script src="/kome/assets/js/chapter.js" type="text/javascript"></script>
    <script src="/kome/assets/js/bookmarks.js" type="text/javascript"></script>
    <script src="/kome/assets/js/rmads.js" type="text/javascript"></script>
@stop