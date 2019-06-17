@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">

        @if(Auth::user()&& Auth::user()->role_id ===1) 
            <h1>Admin Dashboard</h1>
        @elseif(Auth::user()&& Auth::user()->role_id ===2)
            <h1>Author Dashboard</h1>
        @endif
       
    </div>
    @if(Auth::user()&& Auth::user()->role_id ===1) 
        <div class="col-md-12">
         <div class="btn-group">
            <button class="btn btn-primary btn-margin-right">
                <a href="{{route('articles.publish')}}" class="white-text">Publish An Article</a>
            </button>
            <button class="btn btn-danger btn-margin-right">
                <a href="{{route('articles.trash')}}" class="white-text">View Trashed Articles</a>
            </button>
            <button class="btn btn-success btn-margin-right">
                <a href="{{route('categories.publish')}}" class="white-text">Publish Category</a>
            </button>
            <button class="btn btn-primary btn-margin-right">
                <a href="{{route('admin.articles')}}" class="white-text">Manage Articles</a>
            </button>
            <button class="btn btn-success btn-margin-right">
                <a href="{{route('admin.users')}}" class="white-text">Manage Users</a>
            </button>
        </div>
     </div>
     @endif

     @if(Auth::user()&& Auth::user()->role_id ===2) 
        <div class="col-md-12">
         <div class="btn-group">
            <button class="btn btn-primary btn-margin-right">
                <a href="{{route('articles.publish')}}" class="white-text">Publish An Article</a>
            </button>
            <button class="btn btn-success btn-margin-right">
                <a href="{{route('categories.publish')}}" class="white-text">Publish Category</a>
            </button>
        </div>
     </div>
     @endif


</div>

@endsection
