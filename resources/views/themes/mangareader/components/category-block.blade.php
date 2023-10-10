<section class="block_area block_area_sidebar block_area-genres">
    <div class="block_area-header">
        <div class="bah-heading">
            <h2 class="cat-heading">{{ L::_('Genres') }}</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="block_area-content">
        <div class="category_block mb-0">
            <div class="c_b-wrap">
                <div class="c_b-list active">
                    <div class="cbl-row">
                        <div class="item item-focus focus-01">
                            <a href="{{ url('latest-updated') }}" title=""><i class="mr-1">⚡</i>{{ L::_('Latest Updated') }}</a>
                        </div>
                        <div class="item item-focus focus-02">
                            <a href="{{ url('new-release') }}" title=""><i class="mr-1">✌</i>{{ L::_('New Release') }}</a>
                        </div>
                        <div class="item item-focus focus-04">
                            <a href="{{ url('most-viewed') }}" title=""><i class="mr-1">🔥</i>{{ L::_('Most Viewed') }}</a>
                        </div>
                        <div class="item item-focus focus-05">
                            <a href="{{ url('completed') }}" title=""><i class="mr-1">✅</i>{{ l::_('Completed') }}</a>
                        </div>
                    </div>
                    <div class="cbl-row">
                        @foreach(Models\Taxonomy::GetListGenres() as $genre)
                        <div class="item">
                            <a href="{{ url('genres', ['genres' => $genre->slug]) }}" title="{{ $genre->name }}">{{ $genre->name }}</a>
                        </div>
                        @endforeach
                        <div class="item item-more"><a class="im-toggle">+ More</a></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>