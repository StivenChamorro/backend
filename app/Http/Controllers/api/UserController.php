<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::include();

        return response()->json($users);
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:2',
            
        ]);

        $user = User::create($request->all());

        return response()->json($user);
    }

    public function show($id) //si se pasa $id se utiliza la comentada
    {  
        
        $user = User::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        // $category = Category::included();
       // $category = Category::included()->findOrFail($id);
        return response()->json($user);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    public function update(Request $request, User $user){

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:2',
        ]);

        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy(User $user){

        $user->delete();
        return response()->json($user);
    }
}
