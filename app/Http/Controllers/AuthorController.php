<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Get All Authors
     */
    public function index(): JsonResponse
    {
        //
        return response()->json(Author::all(), 200);
    }

    /**
     * Store a newly created author.
     */
    public function store(Request $request): JsonResponse
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);
        return response()->json(Author::create($request->all()), 201);
    }

    /**
     * Display the single author with their books.
     */
    public function show(int $id):JsonResponse
    {
        //
        return response()->json(Author::with('books')->findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id):JsonResponse
    {
        //
        try {
            $author = Author::findOrFail($id);
            if (!$author) {
                return response()->json(['message' => 'Author not found'], 404);
            }
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'bio' => 'nullable|string|max:1000',
            ]);
            $author->update($request->only(['name', 'bio']));
            return response()->json([
                'message' => 'Author updated successfully',
                'author' => $author], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update author',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an author
     */
    public function destroy(int $id):JsonResponse
    {
        //
        try {
            $author = Author::findOrFail($id);
            $author->delete();

            return response()->json([
                'message' => 'Author deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete author',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
