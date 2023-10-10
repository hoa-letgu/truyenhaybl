<div id="unlock-read">
    <div class="read-tips">
        <div class="read-tips-layout">
            <div class="font-weight-bold">{{ L::_('You haven\'t unlocked this chapter yet...') }}</div>

            <div class="read-tips-content mt-3">
                <div class="read-tips-actions">
                    <button onclick="unlockChapter({{ $chapter_id }})" type="button" class="btn btn-primary w-100">
                        <i class="fa fa-shopping-cart"></i>
                        {{ sprintf(L::_('Use %s Token To Unlock'), $chapter->price) }} </a>
                </div>
            </div>
        </div>
    </div>
</div>