<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    //

    public function store(Request $request)
    {

        $request->validate([
            'name' => '|max:255',
            'description' => '|max:500',
            'reward' => '|max:100',
            'children_id' => '|exists:childrens,id',
            'level_id' => '|exists:levels,id',
        ]);

        $achiviement = Achievement::create($request->all());

        return response()->json($achiviement);
    }

    public function index()
    {
        $achiviements = Achievement::all();
        $achiviements = Achievement::included()->get();
        //$achiviements = Achievement::included()->filter()->get();
        //$categories=Category::included()->filter()->sort()->get();
        //$categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($achiviements);
    }

    public function show($id) //si se pasa $id se utiliza la comentada
    {

        $achiviement = Achievement::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        // $category = Category::included();
        // $category = Category::included()->findOrFail($id);
        return response()->json($achiviement);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    public function update(Request $request, Achievement $achiviement)
    {
        $request->validate([
            'name' => '|max:255',
            'description' => '|max:500',
            'reward' => '|max:100',
            'children_id' => '|exists:childrens,id',
            'level_id' => '|exists:levels,id'.  $achiviement->id
        ]);

        $achiviement->update($request->all());

        return response()->json(['message'=>"el registro se actualizo exitosamente", $achiviement]);
    }

    public function destroy(Achievement $achiviement)
    {
        $achiviement->delete();
        return response()->json(['message'=>"el registro se elimino exitosamente", $achiviement]);
    }

}
