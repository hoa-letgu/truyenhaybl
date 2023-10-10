<div class="thumb-item-flow col-4 col-sm-3 col-lg-2 pl-sm-3 pr-sm-3 pl-md-3 pr-md-3 pl-lg-2 pr-lg-2" itemscope=""
     itemtype="https://schema.org/ComicSeries">
    <div class="thumb-wrapper tooltipstered">
        <a title="{{ $manga->name }}"
           href="{{ manga_url($manga) }}">
            <div class="a6-ratio">
                <img alt="{{ $manga->name }}"
                     src="/kome/assets/images/loading.gif"
                     data-src="{{ $manga->cover }}"
                     class="fed-lazy content img-in-ratio"/></div>
        </a>
        <div class="thumb-detail p-lg-2">
            <span class="subscribe-count">
                <i class="ico-star-full"></i> {{ floor(($manga->rating_score / 2) * 2) / 2 }}</span>
            <span class="favorite-count">
                <i class="ico-eye"></i> {{ $manga->views }}</span>
        </div>
    </div>
    <div class=info-botttom>
        <div class="thumb_attr series-title"><h3 itemprop="name"><a
                        href="{{ manga_url($manga) }}"
                        title="{{ $manga->name }}">{{ $manga->name }}</a></h3></div>
        <?php
        $chapters = get_manga_data('chapters', $manga->id, []);
        ?>

        @if(isset($chapters[0]))
            <div itemprop="hasPart" itemscope="" itemtype="https://schema.org/ComicIssue"
                 title="{{ $manga->name }} {{ $chapters[0]->name }}" class="thumb_attr chapter-title text-truncate">
                <a itemprop="url"
                   href="{{ url('chapter', ['m_slug'  => $manga->slug, 'c_slug' => $chapters[0]->slug, 'c_id' => $chapters[0]->id]) }}"
                   title="{{ $manga->name }} {{ $chapters[0]->name }}"><span
                            class="chapname font-weight-bold">{{ $chapters[0]->name }} </span>- {{ timeago($chapters[0]->last_update) }}
                    <meta itemprop="issueNumber" content="{{ $chapters[0]->id }}"/>
                </a>
            </div>
        @endif
    </div>
</div>