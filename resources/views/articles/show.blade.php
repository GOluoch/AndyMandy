@extends('layouts.app')
@include('partials.meta_dynamic')


@section('content')




<div class="container">
    <article>

        <div class="jumbotron">
            <div class="col-md-12">
                @if($article->featured_image)
                    <img src="/images/featured_image/{{ $article->featured_image ? $article->featured_image : '' }}" alt="{{ str_limit($article->title, 50)}}" class="img-responsive featured_image">
                    <br/>
                    <br/>
                @endif
            </div>
            <div class="col-md-12">
                <h1> {{ $article->title}}</h1>
            </div>

            @if(Auth::user())
            @if(Auth::user()->role_id ===1 || Auth::user()->role_id ===2 && Auth::user()->id === $article->user_id)

            <div class="col-md-12">
                <div class="btn-group">
                    <a class="btn btn-primary btn-margin-right btn-margin-right" href="{{ route('articles.edit', $article->id)}}">Edit Article  </a>
                    <form method="post" action="{{ route('articles.delete', $article->id)}}">
                    {{ method_field('delete')}}
                    <button type="submit" class="btn btn-danger">Move to Trash</button>
                    {{ csrf_field() }}
                    </form>
                </div>
            </div>
            @endif
            @endif
        </div>
        <div class="col-md-12">
        {!! $article->body !!}
        <hr>
        @if($article->user)
                Author: <a href="{{ route('authors.show',$article->user->name)}}">{{ $article->user->name}}</a> | Posted: {{ $article->created_at->diffForHumans()}}
            @endif
            <br>
        <strong>Categorised Under : </strong>
        @foreach($article->category as $category)
            <span> <a href="{{ route('categories.show', $category->slug)}}">{{ $category->name }}</a></span>
        @endforeach
        </div>
    </article>
</div>
@endsection
