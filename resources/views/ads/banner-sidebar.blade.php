<?php $code = ""; ?> @if(!empty($code))
@section('banner-sidebar')
{!!base64_decode($code)!!}
@stop
@endif