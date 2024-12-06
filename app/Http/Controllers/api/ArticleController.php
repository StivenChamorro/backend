<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::included() // Incluye relaciones según el parámetro 'included'
            ->filter()   // Aplica filtros según el parámetro 'filter'
            ->sort()     // Ordena los resultados según el parámetro 'sort'
            ->get();     // Obtiene todos los registros
        return response()->json($articles, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:50',
            'store_id' => 'required|exists:stores,id', // Validación de relación con stores
        ]);

        try {
            $image = $request->file('avatar');
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            $imageUrl = $uploadedFile->getSecurePath();

            $article = Article::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'avatar' => $imageUrl,
                'type' => $validated['type'],
                'store_id' => $validated['store_id'],
            ]);

            return response()->json([
                'message' => 'Article created successfully!',
                'article' => $article,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error uploading the image or creating the article.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $article = Article::included()->findOrFail($id);
            return response()->json([
                'message' => 'Article retrieved successfully!',
                'article' => $article,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Article not found.',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'price' => 'required|numeric',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'type' => 'required|string|max:50',
                'store_id' => 'required|exists:stores,id',
            ]);

            if ($request->hasFile('avatar')) {
                if ($article->avatar) {
                    $publicId = pathinfo(parse_url($article->avatar, PHP_URL_PATH), PATHINFO_FILENAME);
                    Cloudinary::destroy($publicId);
                }

                $image = $request->file('avatar');
                $uploadedFile = Cloudinary::upload($image->getRealPath());
                $imageUrl = $uploadedFile->getSecurePath();
            } else {
                $imageUrl = $article->avatar;
            }

            $article->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'avatar' => $imageUrl,
                'type' => $validated['type'],
                'store_id' => $validated['store_id'],
            ]);

            return response()->json([
                'message' => 'Article updated successfully!',
                'article' => $article,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Article not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating the article.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);

            if ($article->avatar) {
                $publicId = pathinfo(parse_url($article->avatar, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            $article->delete();

            return response()->json([
                'message' => 'Article deleted successfully!',
                'article' => $article,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Article not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the article.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function filter(Request $request)
{
    $articles = Article::query();

    if ($request->has('type')) {
        $articles->where('type', $request->type);
    }

    if ($request->has('min_price') && $request->has('max_price')) {
        $articles->whereBetween('price', [$request->min_price, $request->max_price]);
    }

    return response()->json($articles->get(), 200);
}

}
