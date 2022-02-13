@extends('layouts.master')
@section('title', 'Home Page')
@section('content')
    <h1>Dash Board</h1>
    <div id="root"></div>
@endsection
@section('script')
    <script src="{{mix('/js/app.js')}}"></script>
@endsection
