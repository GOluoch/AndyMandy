@extends('layouts.app')

@include('partials.meta_static')

@section('content')


<div class="container-fluid">
    <div class="jumbotron">
        <h1>Manage Articles</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
        <h3>Published</h3>
        <hr>
         @foreach($publishedArticles as $article)

            <h2><a href="{{ route( 'articles.show',$article->id) }}">{{ $article->title}}</a></h2>
            {!! str_limit($article->body, 100) !!} </p>

            <form action="{{route('articles.update', $article->id)}}" method="post">
                 {{ method_field('patch')}}
                        <input type="checkbox" name="status" value="0" checked style="display:none">
                        <button type="submit" class="btn btn-warning">Save to Draft</button>
                 {{ csrf_field() }}
            </form>
            <hr>
        @endforeach
        </div>
        <div class="col-md-6">
            <h3>Draft</h3>
            <hr>
            @foreach($draftArticles as $article)

            <h2><a href="{{ route( 'articles.show',$article->id) }}">{{ $article->title}}</a></h2>
            {!! str_limit($article->body, 100) !!} </p>
            <form action="{{route('articles.update', $article->id)}}" method="post">
                 {{ method_field('patch')}}
                        <input type="checkbox" name="status" value="1" checked style="display:none">
                        <button type="submit" class="btn btn-success">Publish</button>
                 {{ csrf_field() }}
            </form>
            <hr>
            @endforeach
        </div>
    </div>     
</div>
@endsection
