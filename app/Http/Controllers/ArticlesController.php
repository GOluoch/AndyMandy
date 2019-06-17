<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use Session;

class ArticlesController extends Controller
{
    public function __construct(){
        $this->middleware('author',['only'=>['publish','store','edit','update']]);
        $this->middleware('author',['only'=>['delete','trash','restore','permanentDelete']]);
    }

    public function index(){
        //$articles = Article::latest()->get();
        $articles = Article::where('status',1)->latest()->get();
        return view ('articles.index', compact('articles'));
    }

    public function publish(){
        
        $categories = Category::latest()->get();
        return view ('articles.publish', compact('categories'));

    }

    public function store(Request $request){

        $rules = [
            'title'=> ['required', 'min:30', 'max:200'],
            'body' => ['required', 'min:200']
        ];
        $this->validate($request, $rules);
       
       $input = $request->all();

       //This is to take the title and convert it into slug
        $input['slug']= str_slug($request->title);
        $input['meta_title'] = str_limit ($request->title, 55);
        $input['meta_description'] = str_limit ($request->body, 155);




        //this is for the image upload

        if($file = $request->file('featured_image')){
            $name = uniqid(). $file->getClientOriginalName();
            $name = strtolower(str_replace(' ','-',$name));
            $file->move('images/featured_image/', $name);
            $input['featured_image']= $name;
        }


       //$article = Article::create($input);
       $articleByUser = $request->user()->articles()->create($input);

       //sync the articles with the selected categories
       if($request->category_id){
        $articleByUser->category()->sync($request->category_id);
       }


       Session::flash('published_articlee_message','Congratulations. you have succesfully submited your article. Please hold on as the admin review. It will soon be published. Cheers!');
        return redirect('articles');
       
       
        // $article = new Article();
        // $article->title = $request->title;
        // $article->body = $request->body;
        // $article->save();
                

    }
    public function show($slug){
        //$article = Article::findOrFail($id);
        $article = Article::whereSlug($slug)->first();
        return view('articles.show',compact('article'));


    }
    public function edit($id){
        $categories = Category::latest()->get();
        $article = Article::findOrFail($id);


        $articlecategory =array();
        foreach ($article->category as $category){
            $articlecategory []= $category->id-1;
        }
        $filtered = array_except($categories,$articlecategory);

        return view('articles.edit',['article'=>$article, 'categories' => $categories, 'filtered' => $filtered ]);
        
    }
    public function update(Request $request, $id){
        
        $input = $request->all();
        $article = Article::findOrFail($id);


        if($file = $request->file('featured_image')){
            if($article->featured_image){
            unlink('images/featured_image/'.$article->featured_image);

            }
            $name = uniqid(). $file->getClientOriginalName();
            $name = strtolower(str_replace(' ','-',$name));
            $file->move('images/featured_image/', $name);
            $input['featured_image']= $name;
        }

        $article->update($input);

        //sync the articles with the selected categories and the newly selected ones

        if($request->category_id){

            $article->category()->sync($request->category_id);
            }
         return redirect('articles');
    }


    public function delete($id){
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('articles');
    }
    public function trash(){
        $trashedArticles = Article::onlyTrashed()->get();
        return view('articles.trash',compact('trashedArticles'));
    }
    public function restore($id){
        $restoredArticle = Article::onlyTrashed()->findOrFail($id);
        $restoredArticle->restore($restoredArticle);
        return redirect('articles');
    }
    public function permanentDelete($id){
        $permanentDeleteArticle = Article::onlyTrashed()->findOrFail($id);
        $permanentDeleteArticle->forceDelete($permanentDeleteArticle);
        return back();
    }
}
