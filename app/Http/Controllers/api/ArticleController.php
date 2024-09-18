<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::included() // Incluye relaciones según el parámetro 'included'
                            ->filter()   // Aplica filtros según el parámetro 'filter'
                            ->sort()     // Ordena los resultados según el parámetro 'sort'
                            ->getOrPaginate(); // Pagina los resultados si se proporciona el parámetro 'perPage'
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'cost' => 'required|string|max:255',
            'avatar' => 'nullable|string|max:255',
            'description' => 'required|string',
            'id_store' => 'required|exists:stores,id', // Validación adicional para la relación con stores
        ]);

        $article = Article::create($request->all());

        return response()->json($article, 201); // Devuelve el artículo creado y un código 201 (Created)
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::included()->findOrFail($id);
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:255',
            'cost' => 'sometimes|string|max:255',
            'avatar' => 'nullable|string|max:255',
            'description' => 'sometimes|string',
            'id_store' => 'sometimes|exists:stores,id', // Validación para la relación con stores
        ]);

        $article->update($request->all());

        return response()->json($article); // Devuelve el artículo actualizado
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message' => 'Eliminado Correctamente']);
    }
}
