@extends('new_app')


@section('content')

    <h1>Article</h1>
    @foreach($articles as $article)
        <h2>{{{ $article->title }}}</h2>
        <p>{{{ $article->body }}}</p>
    @endforeach





@stop