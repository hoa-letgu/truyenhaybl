<?php $code = "PCEtLSBHb29nbGUgdGFnIChndGFnLmpzKSAtLT4KPHNjcmlwdCBhc3luYyBzcmM9Imh0dHBzOi8vd3d3Lmdvb2dsZXRhZ21hbmFnZXIuY29tL2d0YWcvanM/aWQ9Ry1RSkc5S1FQWEY4Ij48L3NjcmlwdD4KPHNjcmlwdD4KICB3aW5kb3cuZGF0YUxheWVyID0gd2luZG93LmRhdGFMYXllciB8fCBbXTsKICBmdW5jdGlvbiBndGFnKCl7ZGF0YUxheWVyLnB1c2goYXJndW1lbnRzKTt9CiAgZ3RhZygnanMnLCBuZXcgRGF0ZSgpKTsKCiAgZ3RhZygnY29uZmlnJywgJ0ctUUpHOUtRUFhGOCcpOwo8L3NjcmlwdD4="; ?> @if(!empty($code))
@section('head')
{!!base64_decode($code)!!}
@stop
@endif