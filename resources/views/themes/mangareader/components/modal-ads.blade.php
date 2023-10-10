<style>
    .premodal .modal-content .close-modal-ads {
        border-radius: 33px;
        padding: 0;
        width: 25px;
        height: 25px;
        line-height: 12px;
        top: -14px;
        right: -6px;
        font-size: 18px;
        border: 3px solid #eee !important;
    }

    .modal.fade .modal-dialog {
        -webkit-transition: opacity 1.25s linear;
        -moz-transition: opacity 1.25s linear;
        -ms-transition: opacity 1.25s linear;
        -o-transition: opacity 1.25s linear;
        transition: opacity 1.25s linear;
        transform: unset;
    }
</style>
<div class="modal fade premodal" id="modal-ads" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button aria-label="Close" class="close close-modal-ads" id="ads-close" data-dismiss="modal"
                    type="button"><span
                        aria-hidden="true">×</span></button>
            <img onclick="window.open('https://discord.gg/HX2tNBYnvV', '_blank').focus();" class="lazyload"
                 src="https://cdn.discordapp.com/attachments/899172262870142996/926987054074707978/Discord_Giao_luu_3.png">
        </div>
    </div>
</div>

<script>

    window.addEventListener('load', function () {
        setTimeout(function () {
                var hours = 2; // Reset when storage is more than 24hours
                var now = Date.now();
                var setupTime = localStorage.getItem('adsloaded');

                if (setupTime == null || now - setupTime > hours * 60 * 60 * 1000) {
                    $('#modal-ads').modal()
                }

                $('#ads-close').click(function () {
                    localStorage.setItem('adsloaded', now);
                })
            }, 2000
        );
    })
</script>