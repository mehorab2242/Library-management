<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
