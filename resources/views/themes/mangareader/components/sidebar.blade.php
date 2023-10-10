<div id="sidebar_menu_bg"></div>
<div id="sidebar_menu">
    <a class="sb-uimode" href="javascript:;" id="sb-toggle-mode"><i class="fas fa-moon mr-2"></i><span class="text-dm">Dark Mode</span><span
                class="text-lm">Light Mode</span></a>
    <button class="btn toggle-sidebar"><i class="fas fa-angle-left"></i></button>
    <ul class="nav sidebar_menu-list">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('home') }}">{{ L::_('Home') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:;" title="Types">{{ L::_('Types') }}</a>
            <div class="types-sub">
                @foreach(allComicType() as $type_id => $type)
                    <a class="ts-item" href="{{ url('manga.type', ['type' => $type_id]) }}">{{ $type }}</a>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('completed') }}" title="{{ L::_('Completed') }}">{{ L::_('Completed') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('filter') }}" title="{{ L::_("Filter") }}">{{ L::_("Filter") }}</a>
        </li>

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ url('random') }}" title="{{ L::_("Random") }}">{{ L::_("Random") }}</a>--}}
{{--        </li>--}}

        <li class="nav-item">
            <div class="nav-link">
                <strong>{{ L::_("Genres") }}</strong>
            </div>
            <div class="sidebar_menu-sub">
                <ul class="nav sub-menu">
                    @foreach(Models\Taxonomy::GetListGenres() as $genre)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('genres', ['genres' => $genre->slug]) }}" title="{{ $genre->name }}">{{ $genre->name }}</a>
                    </li>
                    @endforeach
                    <li class="nav-item nav-more">
                        <a class="nav-link"><i class="fas fa-plus mr-2"></i>{{ L::_('More') }}</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>