<?php
if (request()->isAjax()) {
       $manga = \Models\Model::getDB()->where('id', $manga_id)->objectBuilder()->getOne('mangas', 'rating_score, total_rating');
}

?>
<div class="block-rating">
    <div class="rating-result">
        <div class="rr-mark float-left">
            <strong><i class="fas fa-star text-warning mr-2"></i>{{ $manga->rating_score }}</strong>
            <small>({{ $manga->total_rating }} voted)</small>
        </div>
        <div class="rr-title float-right">
            {{ L::_('Vote now') }}
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="description">
        {{ L::_('What do you think about this manga?') }}
    </div>
    <div class="button-rate">
        <button class="btn btn-emo rate-bad btn-vote" data-id="{{ $manga_id }}" data-mark="1" type="button">😩<span
                    class="ml-2">{{ L::_('Boring') }}</span></button>
        <button class="btn btn-emo rate-normal btn-vote" data-id="{{ $manga_id }}" data-mark="5" type="button">
            😃<span class="ml-2">{{ L::_('Great') }}</span></button>
        <button class="btn btn-emo rate-good btn-vote" data-id="{{ $manga_id }}" data-mark="10" type="button">
            🤩<span class="ml-2">{{ L::_('Amazing') }}</span></button>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
