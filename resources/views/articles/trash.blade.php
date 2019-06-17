@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>Trashed Articles</h1>
    </div>   
    <div class="col-md-12">
        @foreach($trashedArticles as $article)

            <h2>{{ $article->title}}</h2>
            <p>{{ $article->body}} </p>
            
        
        <!-- form to restore Articles   -->
        <div class="btn-group">
        <form method="get"  action="{{ route('articles.restore', $article->id)}}">
            <button type="submit" class="btn btn-success pull-left btn-margin-right">Restore Articles</button>  
            {{ csrf_field()}}  
        </form>

         <!-- form to restore Articles   -->
         <form method="post"  action="{{ route('articles.permanent-delete', $article->id)}}">
            {{method_field('delete')}}
            <button type="submit" class="btn btn-danger pull-left btn-margin-right">Permanent Delete</button>  
            {{ csrf_field()}}  
        </form>
        </div>
        <hr>
        @endforeach
    </div> 
    
</div>
@endsection
