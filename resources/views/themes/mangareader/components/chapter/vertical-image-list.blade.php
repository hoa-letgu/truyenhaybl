<div id="main-wrapper" class="page-layout page-read">
    <div class="container">
        <div class="container-reader-chapter" id="vertical-content">
            <div class="iv-card loaded" style="display: none;height: 100vh">
                <div class="card-loading ">
                    <div class="c-l-area">
                        <div class="paper-loading"></div>
                        <p class="mb-0">Loading...</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                <button type="button" class="btn btn-danger" id="error_report">

                    <i class="fas fa-exclamation-triangle"></i> Report Error
                </button>
            </div>

            <script>
                $("#error_report").on('click', function(e) {
                    e.preventDefault();

                    let textReport = prompt('{{ L::_("Nhập lỗi bạn gặp phải") }}', "");

                    if (!textReport) {
                        return;
                    }

                    $.post("/api/report/chapter", {
                        content: textReport
                        , chapter_id: readingId
                    }, function() {
                        alert('{{ L::_("Cảm ơn bạn đã báo lỗi, chúng tôi sẽ sớm khắc phục") }}')
                    });
                });

            </script>

            <div class="ads-content">

            </div>
            @foreach($chapter_data->content as $key => $image)
            <div class="iv-card {{ (strpos($image, 'shuffled') !== false) ? " shuffled" : '' }}" data-url="{{ $image }}" data-number="{{ $key }}">

                <div class="card-loading ">
                    <div class="c-l-area">
                        <div class="paper-loading"></div>
                        <p class="mb-0">Loading...</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="ads-content">
                <!-- Banner ngang -->

            </div>

        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="mr-tools mrt-bottom">
    <div class="container">
        <div class="read_tool">
            <div class="float-left" id="ver-prev-cv">
                <div class="rt-item">
                    <button type="button" class="btn btn-navi" onclick="prevChapterVolume();"><i class="fas fa-arrow-left mr-2"></i>Prev Chapter
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="float-right" id="ver-next-cv">
                <div class="rt-item">
                    <button type="button" class="btn btn-navi" onclick="nextChapterVolume();"> Next Chapter<i class="fas fa-arrow-right ml-2"></i></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="dt-rate" id="vote-info">

</div>
