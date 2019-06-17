<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin'], ['only'=> ['articles']]);
        $this->middleware('auth');
    }
    public function index(){
        return view ('admin.dashboard');
    }

    public function articles(){
        $publishedArticles = Article::where('status',1)->latest()->get();
        $draftArticles = Article::where('status',0)->latest()->get();
        return view ('admin.articles', compact('publishedArticles','draftArticles'));
    }
}
