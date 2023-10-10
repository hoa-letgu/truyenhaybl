<div class="category_block category_block-home">
    <div class="container">
        <div class="c_b-wrap">
            <div class="c_b-list">
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
                    <div class="item item-more"><a class="im-toggle">+ {{ L::_('More') }}</a></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>