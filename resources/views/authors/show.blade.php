@extends('layouts.app')

@section('content')

    <div class="contaner">
    <h3>{{ $user->name}}'s recent articles</h3>
    <p>Role : {{ $user->role->name}}</p>
    <hr>
    @foreach($user->articles as $article)
        <h4><a href="{{ route('articles.show', $article->id)}}">{{ $article->title}}</a></h4>

    @endforeach
    
    
    </div>

@endsection