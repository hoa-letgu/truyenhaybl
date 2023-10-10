@if(!empty($mangas))
    @foreach($mangas as $manga)
    <a href="{{ manga_url($manga) }}" class="nav-item">
        <div class="manga-poster"><img
                    src="{{  $manga->cover }}"
                    class="manga-poster-img" alt="{{  $manga->name }}"/></div>
        <div class="srp-detail">
            <h3 class="manga-name">{{  $manga->name }}</h3>
            <div class="film-infor">
                <span>
                    @if($chapters = get_manga_data('chapters', $manga->id))
                                    {{ $chapters[0]->name }}
                    @endif
                </span>
            </div>
        </div>
        <div class="clearfix"></div>
    </a>
    @endforeach

    <a href="{{ url('search', [], ['keyword' => $keyword]) }}" class="nav-item nav-bottom"> {{ L::_("View all results") }}<i
                class="fa fa-angle-right ml-2"></i> </a>
@else
    <a href="javascript:(0);" class="nav-item">
        <span>{{ L::_('No results found!') }}</span>
        <div class="clearfix"></div>
    </a>
@endif