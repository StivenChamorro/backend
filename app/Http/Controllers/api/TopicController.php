<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return response()->json($topics, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        try {
            $image = $request->file('image');
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            $imageUrl = $uploadedFile->getSecurePath();

            $topic = Topic::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image' => $imageUrl,
            ]);

            return response()->json([
                'message' => 'Topic created successfully!',
                'topic' => $topic,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error uploading the image or creating the topic.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $topic = Topic::findOrFail($id);
            return response()->json([
                'message' => 'Registro mostrado exitosamente',
                'topic' => $topic,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Topic not found.',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $topic = Topic::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:50',
                'description' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                // Delete the old image from Cloudinary if it exists
                if ($topic->image) {
                    $publicId = pathinfo(parse_url($topic->image, PHP_URL_PATH), PATHINFO_FILENAME);
                    Cloudinary::destroy($publicId);
                }

                $image = $request->file('image');
                $uploadedFile = Cloudinary::upload($image->getRealPath());
                $imageUrl = $uploadedFile->getSecurePath();
            } else {
                $imageUrl = $topic->image;
            }

            $topic->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image' => $imageUrl,
            ]);

            return response()->json([
                'message' => 'Topic updated successfully!',
                'topic' => $topic,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Topic not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating the topic.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $topic = Topic::findOrFail($id);

            // Delete the associated image from Cloudinary if it exists
            if ($topic->image) {
                $publicId = pathinfo(parse_url($topic->image, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            $topic->delete();

            return response()->json([
                'message' => 'Registro eliminado exitosamente',
                'topic' => $topic,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Topic not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the topic.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
