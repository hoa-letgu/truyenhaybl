<div id="main-content">


    <section id="chapters-list" class="block_area block_area_category block_area_chapters">

        <div id="list-chapter" class="tab-pane active show">
            <div class="chapter-section">
                <div class="chapter-s-lang">
                    <button type="button" class="btn btn-sm">
                        <i class="far fa-file-alt mr-2"></i>
                        <span>{{ ($total_chapters = count($chapters)) }} {{ L::_("chapters")
                            }}</span>
                    </button>

                </div>
                <div class="chapter-s-search">
                    <form class="preform search-reading-item-form">
                        <div class="css-icon"><i class="fas fa-search"></i></div>
                        <input class="form-control search-reading-item" type="text" placeholder="{{ L::_('Number of Chapter') }}" autofocus="">
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="chapters-list-ul">
                <ul class="ulclear reading-list lang-chapters active">
                    <?php
                    ($total_chapters = count($chapters));

                    $total_chapters = $total_chapters + 1;
                    ?>
                    @foreach($chapters as $chapter)
                    <li class="item reading-item chapter-item " data-number="{{ ($total_chapters = $total_chapters - 1) }}">
                        <a href="{{ url('chapter', ['m_slug' => $manga->slug, 'c_id' => $chapter->id, 'c_slug' => $chapter->slug]) }}" class="item-link {{ ((isset($chapter->has_read) && $chapter->has_read) != 0 ? 'visited': '') }}" title="{{ $chapter->name }}">
                            <span class="arrow mr-2"><i class="far fa-file-alt"></i></span>
                            <span class="name">{{ $chapter->name }}</span>

                            @if((!$chapter->price || $chapter->price <= 0 )) <span class="item-read">
                                <i class="fas fa-glasses mr-1"></i> {{ L::_('Free') }} </span>
                                @elseif(isset($chapter->is_unlocked) && $chapter->is_unlocked)
                                <span class="item-read">
                                    <i class="fas fa fa-unlock text-success mr-1"></i> {{ L::_('View') }}

                                </span>

                                @else
                                <span class="item-read">
                                    <i class="fas fa fa-lock text-danger mr-1"></i> {{ L::_('Paid') }}
                                </span>
                                @endif
                        </a>
                        <div class="clearfix"></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <div class="clearfix"></div>
</div>
