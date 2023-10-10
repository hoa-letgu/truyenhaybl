@if($chapter_data->type === 'image')

    @foreach($chapter_data->content as $key => $image)

        <div class="image-placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-index="{{ $key }}" class="lazyload" data-src="{{ $image }}" loading="lazy" alt="Page {{ $key }}">
        </div>
    @endforeach

    <script>
        window.addEventListener("load", () => {
            $.post("/ajax/manga/count-view/" + chapter_id);

            const list = document.querySelectorAll("img.lazyload")
            const len = list.length
            let _idx;
            Object.defineProperty(this, "index", {
                get: function () {
                    return _idx;
                }, set: function (value) {
                    if (value >= len) {
                        return
                    }
                    _idx = value
                    const img = list[index]
                    img.src = img.dataset.src;
                }
            })
            list.forEach(function (img) {
                img.addEventListener("load", function () {
                    img.classList.add("lazyloaded")
                    index = index + 1
                }, {once: true});
                img.addEventListener("error", function () {
                    if (img.src.includes("googleusercontent.com")) {
                        var ID = img.src.split("/d/").pop().split('=s')[0];
                        img.src = "https://www-googleapis-com.translate.goog/drive/v3/files/" + ID + "?alt=media&key=AIzaSyBCkIf9IXzk_69dAV7_CyhC3M7galG23g4&_x_tr_sl=vi&_x_tr_tl=en&_x_tr_hl=en-US&_x_tr_pto=wapp";
                    }

                    img.classList.add("lazyloaded")
                    index = index + 1
                }, {once: true});
            })
            index = 0
            index = 1
            index = 2
        });

    </script>

    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloaded {
            opacity: 1;
            transition: opacity 1000ms;
        }

        .image-placeholder {
            position: relative;
            min-height: 50px;
            margin: auto;

        }

        .image-placeholder img {
            max-width: 800px !important;
            display: inherit;
            margin: 0 auto;
        }

    </style>
@else
    <div class="text-left">
        {!! $chapter_data->content !!}
    </div>
    <style>

    </style>
@endif