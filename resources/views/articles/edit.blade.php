@extends('layouts.app')

@section('content')
@include('partials.tinymce')
<div class="container">
    <div class="jumbotron">
        <h1>Edit Article</h1>
    </div>
    <div class="col-md-12">
        <form action="{{route('articles.update', $article->id)}}" method="post" enctype="multipart/form-data">
           {{ method_field('patch')}}
            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" class="form-control" name="title" value="{{ $article->title}}">
            </div>

            <div class="form-group">
                <label for="body">Article Content</label>
                <!-- <textarea class="form-control" name="body">{{ $article->body}}</textarea> -->
                <textarea name="body" class="form-control my-editor">{{ $article->body}}</textarea>
            </div>
            <div class="form-group form-check form-check-inline">
                {{ $article->category->count() ? 'Selected Categories : ' : ''}} &nbsp;
                @foreach( $article->category as $category)
                    <input type="checkbox" value="{{ $category->id}}" name="category_id[]" class="form-check-input" checked>
                      <label class="form-check-label btn-margin-right">{{ $category->name}}</label>  
                @endforeach
            </div> 
            <br>
            <div class="form-group form-check form-check-inline">
                {{ $filtered->count() ? 'Available Categories : ' : ''}} &nbsp;
                @foreach( $filtered as $category)
                    <input type="checkbox" value="{{ $category->id}}" name="category_id[]" class="form-check-input">
                      <label class="form-check-label btn-margin-right">{{ $category->name}}</label>  
                @endforeach
            </div>
            <div class="fomr-group">
                <label class="btn btn-default">
                    <span class="btn btn-outline btn-info">Click to select  a featured image</span>
                    <input type="file" name="featured_image" class="form-control" hidden>                
                </label>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Update Article</button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
