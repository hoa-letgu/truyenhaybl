@extends('themes.mangareader.layouts.read')

<?php
include(ROOT_PATH . '/resources/views/includes/chapter.php');
?>

@section('title', $metaConf['chapter_title'])
@section('description', $metaConf['chapter_description'])

@section('url', $chapter_url ?? url())
@section('image', $manga->cover)

@section('data-id', $manga->id)

@section('content')
<div id="wrapper" data-reading-id="{{ $chapter->id ?? '' }}" data-reading-by="chap" data-lang-code="en"
    data-manga-id="{{ $manga->id }}">
    <!--Begin: Header-->
    @include('themes.mangareader.components.chapter.header')
    <!--End: Header-->
    <div class="clearfix"></div>
    <div class="mr-tools mrt-top">
        <div class="container">
            <div class="read_tool">
                <div class="float-left">
                    <div class="rt-item">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="btn">{{ L::_('Reading Mode') }}: <span id="current-mode">- {{ L::_('Select') }}
                                -</span> <i class="fas fa-angle-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                            <a class="dropdown-item mode-item" data-value="vertical" href="javascript:;">{{
                                L::_('Vertical') }}</a>
                            <a class="dropdown-item mode-item" data-value="horizontal" href="javascript:;">{{
                                L::_('Horizontal') }}</a>
                        </div>
                    </div>
                    <div class="rt-item">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="btn">{{ L::_('Reading Direction') }}: <span id="current-direction"></span> <i
                                class="fas fa-angle-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                            <a class="dropdown-item direction-item" data-value="rtl" href="javascript:;">RTL</a>
                            <a class="dropdown-item direction-item" data-value="ltr" href="javascript:;">LTR</a>
                        </div>
                    </div>
                    <div class="rt-item">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="btn">{{ L::_('Quality') }}: <span id="current-quality"></span> <i
                                class="fas fa-angle-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                            <a class="dropdown-item quality-item" data-value="high">{{ L::_('High') }}</a>
                            <a class="dropdown-item quality-item" data-value="medium">{{ L::_('Medium') }}</a>
                            <a class="dropdown-item quality-item" data-value="low">{{ L::_('Low') }}</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="float-right">
                    <div class="rt-item" id="rt-close">
                        <button type="button" class="btn"><i class="fas fa-times mr-2"></i>{{ L::_('Close') }}</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div id="images-content">
        <div id="first-read" style="display: none;">
            <div class="read-tips">
                <div class="read-tips-layout">
                    <div class="rtl-head">{{ L::_('Setting for the first time...') }}</div>
                    <div class="description">{{ L::_('Select the reading mode you want. You can re-config in') }}
                        <strong class="ml-2"><i class="fas fa-cog mr-2"></i>{{ L::_('Settings') }} > {{ L::_('Reading
                            Mode') }}</strong>
                    </div>
                    <div class="rtl-rows">
                        <a href="javascript:();" class="rtl-row mode-item" data-value="vertical">
                            <div class="rtl-btn rtl-ver">
                                <div class="rtl-container">
                                    <span></span><span></span><span></span><span></span><span></span><span></span>
                                </div>
                            </div>
                            <div class="label-row">{{ L::_('Vertical Follow') }}</div>
                            <div class="checked"><i class="fas fa-check-circle"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <a href="javascript:;" class="rtl-row mode-item" data-value="horizontal">
                            <div class="rtl-btn rtl-hoz">
                                <div class="rtl-container">
                                    <span></span><span></span><span></span><span></span><span></span><span></span>
                                </div>
                            </div>
                            <div class="label-row">{{ L::_('Horizontal Follow') }}</div>
                            <div class="checked"><i class="fas fa-check-circle"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="main-wrapper" class="page-layout page-read mb-0">
                <div class="page-read-setting">
                    <div class="anis-cover" style="background-image: url({{ $manga->cover ?? "
                        /mangareader/images/share.png" }})"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div id="read-comment">
        <div class="rc-close"><span aria-hidden="true">×</span></div>
        <div class="comments-wrap">
            <div class="sc-header">
                <div class="sc-h-title">{{ (new \Models\Manga)->count_comment($manga->id) }} Comments</div>
                <div class="sc-h-sort">
                    <a class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fas fa-angle-down mr-2"></i>Sort by</a>
                    <div class="dropdown-menu dropdown-menu-model dropdown-menu-normal" aria-labelledby="ssc-list">
                        <a class="dropdown-item cm-sort" data-value="top" href="javascript:;">Top<i
                                class="fas fa-check ml-2" style="display: none;"></i></a>
                        <a class="dropdown-item cm-sort active" data-value="newest" href="javascript:;">Newest<i
                                class="fas fa-check ml-2"></i></a>
                        <a class="dropdown-item cm-sort" data-value="oldest" href="javascript:;">Oldest<i
                                class="fas fa-check ml-2" style="display: none;"></i></a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="content-comments"></div>
        </div>
    </div>
</div>
@stop