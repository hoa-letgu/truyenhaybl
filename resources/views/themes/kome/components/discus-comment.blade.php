<div class="wrap-content-part p-5">
    <div id="binhluan_section">
        <div class="disqus"></div>
    </div>
</div>
<script defer src="/kome/assets/js/jquery.disqusloader.js"></script>
<style>
    iframe[sandbox]:not([sandbox=""]) {
        display: none !important;
    }
</style>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var isLoad = false;
        $(window).scroll(function () {
            if(isLoad){
               return;
            }

            $.disqusLoader('.disqus', {
                scriptUrl: '//username.disqus.com/embed.js',
                throttle: 250,
                laziness: 2,
                disqusConfig: function () {
                    this.page.title = '{{ $manga->name }}';
                    this.page.url = '{{ $manga_url }}';
                    this.page.identifier = '{{ $manga->id }}';
                }
            });
            isLoad = true;
        });
    });
</script>