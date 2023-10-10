<div id="ani_detail">
    <div class="ani_detail-stage">
        <div class="container">
            <div class="detail-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">{{ L::_('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ $manga->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="anis-content">
                <div class="anisc-poster">
                    <div class="manga-poster">
                        <img id="primaryimage"
                             src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                             data-src="{{ $manga->cover }}" class="manga-poster-img lazyload"
                             alt="{{ $manga->name }}">
                    </div>
                </div>
                <div class="anisc-detail">
                    <h1 class="manga-name">{{ $manga->name }}</h1>
                    <div class="manga-name-or">{{ $manga->other_name ?? $manga->name }}</div>
                    <div class="manga-buttons">
                        <a href="{{ url('read_first', ['m_slug' => $manga->slug, 'm_id' => $manga->id]) }}"
                           class="btn btn-primary btn-play smoothlink"><i
                                    class="fas fa-eye mr-2"></i>{{ L::_('Read Now') }}</a>
                        <div class="dr-fav" id="reading-list-info">
                            <a aria-expanded="false" aria-haspopup="true" class="btn btn-light btn-fav "
                               data-toggle="dropdown"><i class="far fa-bookmark"></i> </a>
                        </div>
                    </div>
                    <div class="sort-desc">
                        <div class="genres">
                            @foreach(get_manga_data('genres', $manga->id, []) as $genre)
                                <a href="{{ url('genres', ['genres' => $genre->slug]) }}">{{ $genre->name }}</a>
                            @endforeach

                        </div>

                        @if(!empty(trim($manga->description)))
                            <div class="description">
                                {!!nl2br(trim($manga->description))!!}
                            </div>
                            <div class="description-more">
                                <button type="button" data-toggle="modal" data-target="#modaldesc"
                                        class="btn btn-xs text-white">+ {{ L::_('Read full') }}
                                </button>
                            </div>
                        @else
                            <div class="description">
                            Đọc <b>{{ $manga->name }}</b> truyện tranh có nét vẽ đẹp sắc nét, nội dung hấp dẫn.
                            Đọc truyện <b>{{ mb_strtoupper($manga->other_name ?? $manga->name) }}</b> chap mới nhất ngang raw tại hoimetruyen.com
                            </div>
                        @endif

                        <div class="anisc-info-wrap">
                            <div class="anisc-info">
                                <div class="item item-title">
                                    <span class="item-head">{{ L::_('Type') }}:</span>
                                    <a class="name"
                                       href="{{ ($manga->type ? url('manga.type', ['type' => $manga->type]) : '#') }}">{{ type_name($manga->type) }}</a>
                                </div>
                                <div class="item item-title">
                                    <span class="item-head">{{ L::_('Status') }}:</span>
                                    <span class="name">{{ status_name($manga->status) }}</span>
                                </div>

                                @if(!empty(($authors = get_manga_data('authors', $manga->id, []))))
                                    <div class="item item-title">
                                        <span class="item-head">{{ L::_('Authors') }}:</span>
                                        @foreach($authors as $author)
                                            <a href="{{ url('authors', ['authors' => $author->slug]) }}">{{ $author->name }}</a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="item item-title">
                                    <span class="item-head">{{ L::_('Published') }}:</span>
                                    <span class="name">{{ timeago($manga->created_at) }}</span>
                                </div>
                                @if(!empty(($tartists = get_manga_data('artists', $manga->id, []))))
                                    <div class="item item-title">
                                        <span class="item-head">{{ L::_('Translation') }}:</span>
                                        @foreach($tartists as $tartist)
                                            <a href="{{ url('artists', ['artists' => $tartist->slug]) }}">{{ $tartist->name }}</a>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="item item-title">
                                    <span class="item-head">{{ L::_('Views') }}:</span>
                                    <span class="name">{{ $manga->views }}</span>
                                </div>
                                <div class="detail-toggle">
                                    <button type="button" class="btn btn-sm btn-light"><i
                                                class="fas fa-angle-down mr-2"></i>
                                    </button>
                                </div>
                                <div class="dt-rate" id="vote-info">
                                    @include('themes.mangareader.components.ajax.info-vote')
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="social-in-box">
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>