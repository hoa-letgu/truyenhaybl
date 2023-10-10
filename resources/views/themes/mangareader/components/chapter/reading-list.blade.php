<div class="rt-item rt-chap" id="dropdown-chapters">
    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn">
        <span id="current-chapter"></span><i class="fas fa-angle-down ml-2"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-model dropdown-menu-fixed" aria-labelledby="ssc-list">
        <div class="chapter-list-read">
            <div class="chapter-section">
                <div class="chapter-s-search">
                    <form class="preform search-reading-item-form">
                        <div class="css-icon"><i class="fas fa-search"></i></div>
                        <input class="form-control search-reading-item" type="text" placeholder="{{ L::_(" Number of Chapter") }}" autofocus="autofocus" autocomplete="off">
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="chapters-list-ul">
                <ul class="ulclear reading-list lang-chapters active">
                    <?php
                    $total = count($chapters) + 1;
                    ?>
                    @foreach($chapters as $chapter)
                    <li class="item reading-item chapter-item" data-id="{{ $chapter->id }}" data-number="{{ ($total = $total - 1) }}" data-reading-mode="1">
                        <a href="{{ path_url('chapter', ['m_slug' => $manga_slug, 'c_id' => $chapter->id, 'c_slug' => $chapter->slug]) }}" title="{{ $chapter->name }}" class="item-link {{ ((isset($chapter->has_read) && $chapter->has_read) != 0 ? 'visited': '') }}" data-shortname="{{ (explode(':', $chapter->name)[0]) }}"> <span class="arrow mr-2"><i class="fas fa-caret-right"></i></span> <span class="name">{{ $chapter->name
                                }}</span>
                        </a>
                        <div class="clearfix"></div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
