<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        //
        $query = Book::query();

        if ($request->has('author_id')) {
            $query->where('author_id', $request->get('author_id'));
        }
        if ($request->has('published_year')) {
            $query->where('published_year', $request->get('published_year'));
        }
        return response()->json([$query->with('author')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        //
        $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'nullable|string|max:1000',
           'published_year' => 'required|integer|min:1800|max: ' .date('Y'),
           'author_id' => 'required|exists:App\Models\Author,id',
        ]);
        return response()->json(Book::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($author_id):JsonResponse
    {
        //
        $rv = [
            'author' => Author::find($author_id),
            'books' => [],
        ];
        $rv['books'] = Book::where('author_id', $author_id)->get();
        return response()->json($rv);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id):JsonResponse
    {
        //
        $book = Book::findOrFail($id);
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:1000',
            'published_year' => 'sometimes|integer|min:1800|max:' . date('Y'),
            'author_id' => 'sometimes|exists:authors,id',
        ]);
        $book->update($request->all());
        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        //
        try {
            Book::findOrFail($id)->destroy($id);
            return response()->json([
                'message' => 'Book deleted successfully'
            ], 204);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Failed to delete book',
                'error' => $e->getMessage()
            ]);
        }
    }
}
