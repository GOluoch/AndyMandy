@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>Edit Article Category</h1>
    </div>
    <div class="col-md-12">
        <form action="{{ route('categories.update', $category->id)}}" method="post">
            {{method_field('patch')}}
            <div class="form-group">
            <h2> <label for="name">Updated Category  Title</label></h2>
                <input type="text" class="form-control" name="name" value="{{ $category->name}}">
            </div>
            <button class="btn btn-primary" type="submit">Edit Category</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
