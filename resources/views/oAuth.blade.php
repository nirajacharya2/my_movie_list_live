@extends('app')
@section('title')
O Auth - My Movie List
@endsection
@section('content')

@if (session()->has('userInfo'))
{{ Session::get('userInfo')->username }}
{{ Session::get('userInfo')->user_id }}


@endif



@endsection
