<div id="header" class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container" itemtype="http://schema.org/Organization" style="">
            <div class="navbar-brand mobile">
                <a action="open" id="bar">
                    <span class="ico-grid icon-2x"></span>
                </a>
            </div>
            <a class="NameSize pr-lg-5" href="{{ getConf('site')['site_url'] }}" title="{{ getConf('meta')['home_title'] }}"
               itemprop="url">
                {!! getConf("theme")['logo'] !!}
            </a>

            <div class="navbar-collapse" id="main-nav">
                <ul class="navbar-nav mr-auto" id="main-nav1">
                    <li class="search-mb">
                        <div id="search-mobile">
                            <div class="wrap-content-part mb-1">
                                <form action="{{ url("search") }}" method="get">
                                    <input aria-label="search" class="form-control mr-sm-2" id="txtSearchMB"
                                           name="keyword" placeholder="{{ L::_("Search") }}..."
                                           type="search"/>
                                    <button id="btnsearchMB" aria-label="search" type="submit">
                                        <span class="ico-search"></span></button>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a title="{{ L::_("All Manga") }}" class="nav-link" href="{{ url("manga_list") }}">
                            {{ L::_("All Manga") }} </a></li>
                    <li class="nav-item dropdown nav-theloai">
                        <a title="{{ L::_("Genres") }}" aria-expanded="false"
                           aria-haspopup="true" class="nav-link dropdown-toggle"
                           data-toggle="dropdown" href="#" id="wrap_lst_theloai"
                           role="button">{{ L::_("Genres") }}</a>
                        <div aria-labelledby="navbarDropdown fade-down" class="dropdown-menu" id="list_theloai">
                            @foreach(Models\Taxonomy::GetListGenres() as $genre)
                                <a class="dropdown-item" data-title="{{ $genre->name }}" title="{{ $genre->name }}"
                                   href="{{ url('genres', ['genres' => $genre->slug]) }}" target="_self">
                                    {{ $genre->name }}
                                </a>
                            @endforeach

                        </div>
                    </li>
                </ul>
                <form action="{{ url("search") }}" class="form-inline my-2 my-lg-0" id="search_form" method="get" name="search_form">
                    <input aria-label="Search" class="form-control mr-sm-2" id="txtSearch" name="keyword"
                           placeholder="{{ L::_("Search") }}..." type="search"/>
                    <button aria-label="search" id="btnsearch" type="submit"><span class="ico-search"></span></button>
                </form>
                <div class="navbar-nav" id="rightmenu">
                    @if(!is_login())
                        <div class="nav-item dropdown">
                            <a class="link_dangnhap" href="{{ path_url("user.login") }}"> <i class="ico-user"></i>
                                {{ L::_("Login") }}</a></div>
                    @else
                        <div class="nav-item dropdown">
                            <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                               data-toggle="dropdown" href="#" id="navbarDropdown" role="button">
                                <img height="32" id="avatar" alt="{{ userget()->name }}" src="{{ userget()->avatar_url }}"
                                     width="32">
                            </a>
                            <div aria-labelledby="navbarDropdown" class="dropdown-menu dropshadow">
                                @if((new \Models\User)->hasPermission(['all', 'manga']))
                                    <a class="dropdown-item" href="{{ path_url('admin') }}">{{ L::_("Admin") }}</a>
                                @endif
                                <a class="dropdown-item" href="{{ path_url("history") }}">{{ L::_("History") }}</a>
                                <a class="dropdown-item"
                                   href="{{ path_url("user.reading-list") }}">{{ L::_("Bookmark") }}</a>
                                <a class="dropdown-item" href="{{ path_url("logout") }}">{{ L::_("Logout") }}</a></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
