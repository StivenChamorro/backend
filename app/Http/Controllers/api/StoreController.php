<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Muestra una lista de recursos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $stores = Store::included() // Incluye relaciones según el parámetro 'included'
                       ->filter()   // Aplica filtros según el parámetro 'filter'
                       ->sort()     // Ordena los resultados según el parámetro 'sort'
                       ->getOrPaginate(); // Pagina los resultados si se proporciona el parámetro 'perPage'
                       
        return response()->json($stores);
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
            'name' => 'required|string|max:255',
        ]);

        $store = Store::create($request->all());

        return response()->json($store, 201); // Retorna un código 201 (Creado)
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $store = Store::included()->findOrFail($id); // Incluye relaciones según el parámetro 'included'
        
        return response()->json($store);
    }

    /**
     * Actualiza el recurso especificado en almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $store->update($request->only(['name'])); // Solo actualiza el campo 'name'

        return response()->json($store);
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Store $store)
    {
        $store->delete();
        
        return response()->json(['message' => 'Eliminado Correctamente']);
    }
}
