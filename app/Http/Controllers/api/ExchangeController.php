<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Children;
use App\Models\Exchange;
use Illuminate\Http\Request;
use App\Models\Image_User;

class ExchangeController extends Controller
{
    /**
     * Muestra una lista de recursos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $exchanges = Exchange::included() // Incluye relaciones según el parámetro 'included'
                             ->filter()   // Aplica filtros según el parámetro 'filter'
                             ->sort()     // Ordena los resultados según el parámetro 'sort'
                             ->getOrPaginate(); // Pagina los resultados si se proporciona el parámetro 'perPage'
                             
        return response()->json($exchanges);
    }



    /**
     * Almacena un recurso recién creado en almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'children_id' => 'required|exists:childrens,id',
            'article_id' => 'required|exists:articles,id',
            'description' => 'nullable|string|max:255',
        ]);
    
        $children = Children::find($request->children_id);
        if (!$children) {
            return response()->json(['error' => 'Child not found.'], 404);
        }
    
        $article = Article::find($request->article_id);
        if (!$article) {
            return response()->json(['error' => 'Article not found.'], 404);
        }
    
        if ($children->diamonds < $article->price) {
            return response()->json(['error' => 'Not enough gems.'], 400);
        }
    
        $children->diamonds -= $article->price;
        $children->save();
    
        $exchange = Exchange::create([
            'children_id' => $children->id,
            'article_id' => $article->id,
            'price' => $article->price,
            'description' => $request->description ?? 'canje exitoso',
        ]);
    
        // Obtener el artículo desde el exchange
        $article = Article::find($exchange->article_id);
        if (!$article || !$article->avatar) {
            return response()->json(['error' => 'Article or avatar not found.'], 400);
        }
    
        // Crear el registro en `image_users`
        Image_User::create([
            'exchange_id' => $exchange->id,
            'url_imagen' => $article->avatar,
        ]);
    
        return response()->json(['success' => 'Purchase completed successfully.'], 200);
    }

    

    /**
     * Muestra el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $exchange = Exchange::included()->findOrFail($id); // Incluye relaciones según el parámetro 'included'
        
        return response()->json($exchange);
    }

    /**
     * Actualiza el recurso especificado en almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exchange  $exchange
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Exchange $exchange)
    {
        $request->validate([
            'description' => 'nullable|string|max:255',
            'id_children' => 'required|exists:childrens,id',
            'id_article' => 'required|exists:articles,id',
        ]);

        $exchange->update($request->all());

        return response()->json($exchange);
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $exchange = Exchange::find($id);

        if (!$exchange) {
            return response()->json(['message' => 'No existe ese registro'], 404);
        }

        $exchange->delete();
        
        return response()->json(['message' => 'Eliminado Correctamente']);
    }
}
