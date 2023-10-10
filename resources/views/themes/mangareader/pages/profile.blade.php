@extends('themes.mangareader.layouts.full')
@section('title', L::_("Profile Manager"))

@section('content')
    <div id="main-wrapper">
        <div class="container">
            <div id="mw-2col">
                <!--Begin: main-content-->
            @include('themes.mangareader.components.user.profile')
            <!--/End: main-content-->
                <!--Begin: main-sidebar-->
            @include('themes.mangareader.components.user.main-sidebar')
            <!--/End: main-sidebar-->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@stop

@section('modal')
    @include('themes.mangareader.components.user.avatar-modal')
@stop

@section('js-body')
    <script>
        $('#profile-form').submit(function (e) {
            e.preventDefault();

            $('#profile-loading').show();

            var formData = $(this).serialize();

            $.post('/ajax/user/profile', formData, function (res) {
                $('#profile-loading').hide();
                if (res.status) {
                    $('#pro5-currentpass').val('');
                    $('#pro5-pass').val('');
                    $('#pro5-confirm').val('');
                    $('#show-changepass').collapse('hide');
                    toastr.success(res.msg, '', {timeout: 5000});
                    if ($('#note-change-email').length > 0) {
                        window.location.reload();
                    }
                } else {
                    toastr.error(res.msg, '', {timeout: 5000});
                }
            });
        });

        $('.item-avatar').click(function () {
            $('.item-avatar').removeClass('active');
            $(this).addClass('active');
            $('#preview-avatar').attr('src', $(this).find('img').attr('src'));
            $.post('/ajax/user/profile', {avatar_id: $(this).data('id')}, function (res) {
                if (res) {
                    toastr.success(res.msg, '', {timeout: 5000});
                } else {
                    toastr.error(res.msg, '', {timeout: 5000});
                }
            });
        });
    </script>
@stop