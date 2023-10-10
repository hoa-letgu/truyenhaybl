@extends('themes.mangareader.layouts.full')

<?php
include(ROOT_PATH . '/resources/views/includes/manga.php');
?>

@section('title', $metaConf['manga_title'])
@section('description', $metaConf['manga_description'] )
@section('url', $manga_url)
@section('image', $manga->cover)

@section('data-id', $manga->id)

@section('schema')
<script type="application/ld+json">
    {
        !!manga_schema($manga) !!
    }

</script>

<script type="application/ld+json">
    {
        !!chaps_schema($manga, $chapters) !!
    }

</script>

@stop

@section('content')
<!--Begin: Detail-->
@include('themes.mangareader.components.manga.detail')
<!--/End: Detail-->
<!--Begin: Main-->
<div id="main-wrapper" class="page-layout page-detail">
    <div class="container">
        <div id="mw-2col">
            <!--Begin: main-content-->
            @include('themes.mangareader.components.manga.main-content')
            <!--/End: main-content-->
            
            <!--Begin: main-sidebar-->
            @include('themes.mangareader.components.manga.main-sidebar')
            <!--/End: main-sidebar-->
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@stop

@section('modal')
@include('themes.mangareader.components.manga.modal-description')
@stop
@section('js-body')
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            getScript('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61310d692ddb96c6');
            getScript('https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js');

            readingListInfo('detail');
        }, 1000);

        $(".detail-toggle").click(function(e) {
            $(this).toggleClass("active");
            $(".anis-content").toggleClass("active");
        });
    })

</script>
@stop
