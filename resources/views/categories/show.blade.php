@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
            <h1>{{ $category->name }}</h1>

            <div class="btn-group">
                <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-warning btn-margin-right">Edit Category</a>

                <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                {{ method_field('delete')}}
                <button  type="submit" class="btn btn-danger pull-left">Delete Category</button>
    
                {{ csrf_field() }}
                </form>
            </div>
    </div>
    <div class="col-md-12">
        @foreach($category->article as $article)
            <h3><a href="{{ route('articles.show',$article->id)}}">{{ $article->title}}</a></h3>
            <hr>
        @endforeach
        
    </div>
</div>


    
@endsection
