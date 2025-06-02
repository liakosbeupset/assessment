@extends('layouts.main')

@section('content')
    <h1>Hello index!</h1>
    <a href="{{route('posts.all')}}">View Posts</a>
@endsection
