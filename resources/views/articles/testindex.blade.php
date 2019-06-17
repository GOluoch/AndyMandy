@extends('layouts.app')

@include('partials.meta_static')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="container">

        @if(Session::has('published_articlee_message'))
            <div class="alert alert-success">
                {{ Session::get('published_articlee_message')}}
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        @endif

        @foreach($articles as $article)

            <h2><a href="{{ route( 'articles.show',[$article->slug]) }}">{{ $article->title}}</a></h2>
           <p> {!! $article->body !!} </p>
            @if($article->user)
                Author: <a href="{{ route('authors.show',$article->user->name)}}">{{ $article->user->name}}</a> | Posted: {{ $article->created_at->diffForHumans()}}
            @endif
            <hr>
        @endforeach
        </div>
    </div>
</div>
@endsection
