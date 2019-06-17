@extends('layouts.app')

@section('content')
@include('partials.tinymce')
<div class="container">
    <div class="jumbotron">
        <h1>Publish a new Article</h1>
    </div>
    <div class="col-md-12">
        <form action="{{route('articles.store')}}" method="post" enctype="multipart/form-data">

            @include('partials.error-message')

            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group">
                <label for="body">Article Content</label>
                <textarea name="body" class="form-control my-editor">{!! old('body') !!}</textarea>
                
            </div>            
            <div class="form-group form-check form-check-inline">
                @foreach( $categories as $category)
                    <input type="checkbox" value="{{ $category->id}}" name="category_id[]" class="form-check-input">
                      <label class="form-check-label btn-margin-right">{{ $category->name}}</label>  
                @endforeach
            </div>
            <!-- <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" name="featured_image" class="form-control">
            </div> -->

            <div class="fomr-group">
                <label class="btn btn-default">
                    <span class="btn btn-outline btn-info">Click to select  a featured image</span>
                    <input type="file" name="featured_image" class="form-control" hidden>                
                </label>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Publish</button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
