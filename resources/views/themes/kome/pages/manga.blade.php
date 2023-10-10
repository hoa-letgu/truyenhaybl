@extends('themes.kome.layouts.full')
<?php
include(ROOT_PATH . '/resources/views/includes/manga.php');
$manga->rating_score = floor(($manga->rating_score / 2) * 2) / 2;
if ($manga->rating_score <= 0) {
    $manga->rating_score = 5;
    $manga->total_rating = 1;
}
?>

@section('title', $metaConf['manga_title'])
@section('description', $metaConf['manga_description'] )
@section('url', $manga_url)
@section('image', $manga->cover)

@include('ads.banner-ngang')
@include('ads.banner-sidebar')

@section("head-css")
    <link href="/kome/assets/css/manga.css" rel="stylesheet" type="text/css"/>
    <link  href="/kome/assets/css/rating.css" rel="stylesheet" type="text/css"/>
@stop

@section("body-js")
    <script type="text/javascript">
        var rating_point = "{{ $manga->rating_score }}";
        var manga_id = {{ $manga->id }};
    </script>

    <script src="/kome/assets/js/manga.js" type="text/javascript"></script>
    <script src="/kome/assets/js/bookmarks.js" type="text/javascript"></script>

    <script src="/kome/assets/js/rmads.js" type="text/javascript"></script>


@stop

@section("manga-breadcrumb")
    <nav class="manga-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb" itemscope=""
            itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem">
                <a title="Home" href="{{ url('home') }}" itemprop="item">
                    <span itemprop="name">{{ L::_("Home") }}</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem">
                <a title="Manga List" href="{{ url("manga_list") }}" itemprop="item">
                    <span itemprop="name">{{ L::_("Manga") }}</span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem">
                <a title="{{ $manga->name }}"
                   href="{{ $manga_url }}"
                   style="color: unset;" itemprop="item">
                    <span itemprop="name">{{ $manga->name }} </span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        </ol>
    </nav>
@stop

@section("detail-story")
    <div class="wrap-detail-story" itemscope="" itemtype="http://schema.org/ComicSeries">
        <div class="wrap-content-image" itemtype="https://schema.org/ImageObject">
            <img alt="{{ $manga->name }}"
                 itemprop="image"
                 src="{{ $manga->cover }}">
        </div>
        <div class="wrap-content-info">
            <h1 class="title" itemprop="name">{{ $manga->name }}</h1>
            <div class="list-info">
                <div class="info-row"><b class="info-title"><i class="ico-plus"></i> {{ L::_("Other Name") }}</b>:
                    <span>{{ $manga->other_name ?? L::_("Updating") }}</span>
                </div>
                <div class="info-row">
                    <b class="info-title"><i class="ico-paint-brush"></i> {{ L::_("Author") }}</b> :
                    @if(!empty(($authors = get_manga_data('authors', $manga->id, []))))
                        @foreach($authors as $author)
                            <a href="{{ url('authors', ['authors' => $author->slug]) }}"
                               rel="tag">{{ $author->name }}</a>
                        @endforeach
                    @else
                        <span> {{ L::_("Updating") }}</span>
                    @endif
                </div>
                <div class="info-row">
                    <b class="info-title"><i class="ico-rss"></i> {{ L::_("Status") }}</b> :
                    <span>{{ status_name($manga->status) }}<span></span></span>
                </div>
                <div class="info-row">
                    <b class="info-title"><i class="ico-eye"></i> {{ L::_("Views") }}</b> :
                    <span>{{ $manga->views }}</span>
                </div>
                <div class="row rating">
                    <div class="col-sm-6">
                        <div id="rating">
                            @for($i=5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                                <label class="full" for="star{{ $i }}" title="Awesome - {{ $i }} stars"></label>
                            @endfor
                        </div>
                    </div>
                </div>
                <div itemscope="" itemtype="http://schema.org/Book">
                    <span itemprop="name" class="title-rating"> {{ $manga->name }} </span>
                    <span itemprop="aggregateRating" itemscope=""
                          itemtype="https://schema.org/AggregateRating"> Rank:
                        <span itemprop="ratingValue">{{ $manga->rating_score }}</span>/5 -
                        <span itemprop="ratingCount">{{ $manga->total_rating }}</span> Evaluate.</span>
                    <meta property="worstRating" content="1">
                    <meta property="bestRating" content="5">
                </div>
                <div class="info-row list01 li03">
                    @foreach(get_manga_data('genres', $manga->id, []) as $genre)
                        <a class="genner-block" href="{{ url('genres', ['genres' => $genre->slug]) }}"
                           title="{{ $genre->name }}" rel="tag">{{ $genre->name }}</a>
                    @endforeach
                </div>

                <div class="info-row theodoitruyen">
                    <a href="#" action="bookmark"
                       class="centertextblock1 btn-top11 btn-primary btn_theodoitruyen shadow-none "
                       id="btn_theodoitruyen">
                        <i class="ico-bookmark"></i> {{ L::_("Bookmark") }}</a>
                    <span class="total-bookmarks">
                        <b id="total-bookmark" total="{{ $manga->total_bookmarks }}">{{ $manga->total_bookmarks }}</b> {{ L::_("User bookmarked") }}</span>
                </div>
                <div class="info-row info-links" style="margin-top: 5px;">
                    <a class="centertextblock1 btn-top11 btn-primary shadow-none"
                       href="{{ (isset($chapters) ? chapter_url($manga, $chapters[count($chapters)-1]) : '#') }}"
                       id="doctudau"
                       style="margin-right: 10px;">{{ L::_("Read First") }}</a>
                    <a class="centertextblock1 btn-top11 btn-primary shadow-none"
                       href="{{ (isset($chapters) ? chapter_url($manga, $chapters[0]) : '#') }}" id="docmoinhat"
                       style="margin-right: 5px;">{{ L::_("Read Last") }}</a></div>
            </div>
        </div>
        <br class="clear"></div>
@stop

@section("detail-content")
    <div class="wrap-detail-taiapp">
        <div class="detail-content" style="line-height: 30px;">
            <h3 class="h4 font-weight-bold medium-size">SUMMARY</h3>
            <p class="shortened">{{ $manga->description }}</p>
            <a href="#" class="morelink">{{ L::_("View more") }}</a>
        </div>
    </div>
@stop

@section('content')
    <div class="fed-part-case" id="main-content">
        <div class="wrap-content-part">
        @yield("manga-breadcrumb")

        <!--  Detail Manga -->
        @yield("detail-story")

        <!--  Description -->
            @yield("detail-content")
        </div>

        <div class="wrap-content-part">

            <div class="header-content-part part-list-chap">
                <div class="title">
                    <span class="icon-title icon-2x ico-star-full"></span> {{ L::_("Chapters List") }} <span
                            id="reverse-order" class="more ico-swap"></span></div>
            </div>

            <div class="body-content-part" id="danhsachchuong">
                <ul class="lst-chapter" id="list-chapter">

                    <?php
                    $max_show = 10;
                    $num = 1;
                    ?>
                    @foreach ($chapters as $chapter)
                        <li class="chap-item {{ ($num > $max_show ? 'less' : '') }}">
                            <a href="{{ url('chapter', ['m_slug' => $manga->slug, 'c_slug' => $chapter->slug, 'c_id' => $chapter->id]) }}"
                               title=" {{ $manga->name }} {{ $chapter->name }}"
                               itemprop="url"> {{ $chapter->name }} </a>
                            <span class="chapter-release-date">{{ $chapter->views }} {{ L::_("views") }} - {{ date('Y-m-d', strtotime($chapter->last_update)) }} </span>
                        </li>

                        <?php $num++;?>
                    @endforeach


                </ul>

                @if(count($chapters) > $max_show)
                    <a class="list-chap view-more" href="#">{{ L::_("View more") }} </a>
                @endif

            </div>

            @include("themes.kome.components.discus-comment")
        </div>
    </div>

@stop
