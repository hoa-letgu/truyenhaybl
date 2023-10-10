@extends('themes.mangareader.layouts.full')

@section('title', L::_('Notification'))

@section('content')
<div id="main-wrapper">
    <div class="container">
        <div id="mw-2col">
            <div id="main-content">
                <!--Begin: main-content-->
                <section class="block_area block_area_profile">
                    <div class="block_area-header">
                        <div class="bah-heading">
                            <h2 class="cat-heading">Notifications</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="block_area-content">
                        <div class="inbox-list">
                            <div class="inbox-tabs">
                                <div class="float-right">
                                    <a data-position="page" class="btn btn-sm btn-blank notify-seen-all" style="font-size: 12px;"><i class="fas fa-check mr-1"></i> Mark <span class="d-none d-sm-inline">all as</span> read</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        <div class="inbox-item-list">
                            @foreach($notifications as $notification)
                            <div class="inbox-item ">
                                <div class="ii-content">
                                    <div class="ii-text">
                                        @if($notification->url)
                                        <a href="{{$notification->url}}" class="ii-link">
                                             {!!$notification->msg!!}
                                        </a>
                                        @else
                                        {!!$notification->msg!!}
                                        @endif
                                            
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            @endforeach
                        </div>

                        <div class="pre-pagination mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-lg justify-content-center">
                                    @if ($page > 1)
                                    <li class="page-item">
                                        <a class="page-link href="{{ url(null, null, [
                                            'page' => $page,
                                        ]) }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @endif
                                    
                                    @for($i = ($page > 2 ? $page - 2 : 1); $i <= ($page>= $totalPage - 2 ? $totalPage : $page + 2) ; $i++)                                
                                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ url(null, null, [
                                            'page' => $i,
                                        ]) }}">{{ $i }}</a>
                                    </li>
                                    @endfor


                                    @if ($page < $totalPage)
                                    <li class="page-item">
                                        <a class="page-link {{ $page == $totalPage ? 'disable' : '' }}" href="{{ url(null, null, [



                                            'page' => $page < $totalPage ? $page + 1 : $totalPage,
                                        ]) }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </section>
                <!--/End: main-content-->
  </div>



                <!--Begin: main-sidebar-->
                @include('themes.mangareader.components.user.main-sidebar')
                <!--/End: main-sidebar-->
                <div class="clearfix"></div>
          
        </div>
    </div>
</div>

@endsection
