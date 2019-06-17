<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('categories.index',['categories'=> $categories]);
    }

    public function publish(){
        return view ('categories.publish');
    }

    public function store(Request $request){
        //creating categories by passing an array of data. key value pairs
        //dd($request->name);
        Category::create([
            'name' => $request['name'],
            'slug' => str_slug($request['name'],'-'),
        ]);
        return redirect('categories');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    public function show($slug){
        $category = Category::where('slug',$slug)->first();
        return view('categories.show', compact('category'));

    }
    public function update(Request $request,$id){
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name, '-');
        $category->save();
        return redirect('categories');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('categories');
    }
}
