<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    //
    public function index()
    {
        $achievements = Achievement::all();
        $achievements = Achievement::included()->get();
        $achievements = Achievement::included()->filter()->get();
        //$categories=Category::included()->filter()->sort()->get();
        //$categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($achievements);
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'max:255',
            'description' => 'max:500',
            'reward' => 'max:255',
            'children_id' => 'exists:childrens,id',
            'level_id' => 'exists:levels,id',
            'status' => 'in:blocked,unblocked',
        ]);

        $achievement = Achievement::create($request->all());

        return response()->json($achievement);
    }

    public function show($id) //si se pasa $id se utiliza la comentada
    {

        $achievement = Achievement::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        // $category = Category::included();
        // $category = Category::included()->findOrFail($id);
        return response()->json($achievement);
        //http://api.backend.test/v1/achievement/index
    }

    public function update(Request $request, Achievement $achievement)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'max:255',
            'description' => 'max:500',
            'reward' => 'max:255',
            'children_id' => 'exists:childrens,id',
            'level_id' => 'exists:levels,id',
            'status' => 'in:blocked,unblocked',
        ]);


        if (!$achievement) {
            return response()->json(['error' => 'Achievement not found'], 404);
        }
        $achievement->update($request->all());

        return response()->json(['message' => "El registro se actualizó exitosamente", 'achievement' => $achievement]);

    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json(['message'=>"el registro se elimino exitosamente", $achievement]);
    }

}
