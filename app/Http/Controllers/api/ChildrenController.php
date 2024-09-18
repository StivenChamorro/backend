<?php

namespace App\Http\Controllers;

use App\Models\Children;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index(){
        $childrens = Children::include();

        return response()->json($childrens);
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'age' => 'required|max:2',
            'nickname' => 'required|max:255',
            'relaction' => 'required|max:255',
            'avatar' => 'required|max:100',
            'gender' => 'required|max:100',
            'user_id' => 'required|max:100',
        ]);

        $children = Children::create($request->all());

        return response()->json($children);
    }

    public function show($id) //si se pasa $id se utiliza la comentada
    {  
        
        $children = Children::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        // $category = Category::included();
       // $category = Category::included()->findOrFail($id);
        return response()->json($children);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    public function update(Request $request, Children $children){

        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'age' => 'required|max:2',
            'nickname' => 'required|max:255',
            'relaction' => 'required|max:255',
            'avatar' => 'required|max:100',
            'gender' => 'required|max:100',
            'user_id' => 'required|max:100',
        ]);

        $children->update($request->all());

        return response()->json($children);
    }

    public function destroy(Children $children){

        $children->delete();
        return response()->json($children);
    }
}

