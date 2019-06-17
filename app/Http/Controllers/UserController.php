<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    
    }


    public function index(){
        return view ('admin.users')->with('users', User::all());
    }



    public function update(Request $request, $id){
        User::findOrFail($id)->update($request->only('role_id'));
        return back();
    }

    

    public function destroy(User $user){
        $user->delete();
        return back();
    }

    public function show($name){
        $user = User::where('name', $name)->first();
        return view('authors.show', compact('user'));
    }
}
