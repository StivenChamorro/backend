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
        //http://api.backend.test/v1/achievement?included=Children
    }

    public function update(Request $request, Achievement $achiviement)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'reward' => 'nullable|integer|max:100',
            'children_id' => 'nullable|exists:childrens,id',
            'level_id' => 'nullable|exists:levels,id',
        ]);


        if (!$achiviement) {
            return response()->json(['error' => 'Achievement not found'], 404);
        }
        $achiviement->update($request->all());

        return response()->json(['message' => "El registro se actualizó exitosamente", 'achievement' => $achiviement]);

    }

    public function destroy(Achievement $achiviement)
    {
        $achiviement->delete();
        return response()->json(['message'=>"el registro se elimino exitosamente", $achiviement]);
    }

}
