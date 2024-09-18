<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Image_User;
use Illuminate\Http\Request;

class ImageUserController extends Controller

{
    //
    public function store(Request $request)
    {

        $request->validate([
            'image' => '|max:255',
            'exchange_id' => '|exists:exchanges,id',

        ]);

        $image_user = Image_User::create($request->all());

        return response()->json($image_user);
    }

    public function index()
    {
        $image_users = Image_User::all();
        $image_users = Image_User::included()->get();
        $image_users = Image_User::included()->filter()->get();
        //$categories=Category::included()->filter()->sort()->get();
        //$categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($image_users);
    }

    public function show($id) //si se pasa $id se utiliza la comentada
    {

        $image_user = Image_User::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        // $category = Category::included();
        // $category = Category::included()->findOrFail($id);
        return response()->json($image_user);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    public function update(Request $request, Image_User $imageUser)
    {
        $request->validate([
            'image' => '|max:255',
            'exchange_id' => '|exists:exchanges,id' . $imageUser->id
        ]);

        $imageUser->update($request->all());

        return response()->json(['message'=>"el registro se actualizo exitosamente", $imageUser]);
    }

    public function destroy(Image_User $imageUser)
    {
        $imageUser->delete();
        return response()->json(['message'=>"el registro se elimino exitosamente", $imageUser]);
    }

}


