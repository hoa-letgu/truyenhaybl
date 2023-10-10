<div id="main-wrapper">
    <div class="container">
        <div id="mw-2col">
            <!--Begin: main-content-->
            
            @include('themes.mangareader.components.home.main-content')
            <!--/End: main-content-->

            <!--Begin: main-sidebar-->
            @include('themes.mangareader.components.home.main-sidebar')

            <!--/End: main-sidebar-->
            <div class="clearfix"></div>
            @include('themes.mangareader.components.home.completed')
            <div class="clearfix"></div>
        </div>
    </div>
</div>