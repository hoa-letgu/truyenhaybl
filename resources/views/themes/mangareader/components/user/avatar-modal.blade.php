<?php
use Models\User;
$avatars = User::avatarList();
$tags = array_keys($avatars);
?>
<div class="modal fade premodal premodal-avatars" id="modalavatars" tabindex="-1" role="dialog"
     aria-labelledby="modalcharacterstitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Avatar</h5>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs pre-tabs pre-tabs-min pre-tabs-hashtag" style="margin-top: -5px">
                    @foreach($tags as $key => $tag)
                    <li class="nav-item">
                        <a data-toggle="tab" href="#hashtag-{{ $key }}" class="nav-link {{ $key === 0 ? 'active' : '' }}">#{{ $tag }}</a>
                    </li>

                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($tags as $key => $tag)
                    <div id="hashtag-{{ $key }}" class="tab-pane fade {{ $key === 0 ? 'active show' : '' }}">
                        <div class="avatar-list">
                            @foreach($avatars[$tag] as $key => $avatar)
                            <div class="item item-avatar {{ $avatar->id === userget()->avatar_id ? 'active' : ''}}"
                                 data-id="{{ $avatar->id }}">
                                <div class="profile-avatar">
                                    <img src="{{ $avatar->url }}" alt="Avatar {{ $avatar->id }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <a data-dismiss="modal" aria-label="Close" class="btn btn-block btn-secondary mt-4">Close</a>
            </div>
        </div>
    </div>
</div>