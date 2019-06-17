@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>Publish a new Article Category</h1>
    </div>
    <div class="col-md-12">
        <form action="{{ route('categories.store')}}" method="post">
            <div class="form-group">
            <h2> <label for="name">Category  Title</label></h2>
                <input type="text" class="form-control" name="name">
            </div>
            <button class="btn btn-primary" type="submit">Publish Category</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
