@extends('layouts.main')

@section('content')
    <div id="app">
        <posts :items='@json($items)'></posts>
    </div>
@endsection
