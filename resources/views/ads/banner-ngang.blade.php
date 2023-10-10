<?php $code = ""; ?> @if(!empty($code))
@section('banner-ngang')
{!!base64_decode($code)!!}
@stop
@endif