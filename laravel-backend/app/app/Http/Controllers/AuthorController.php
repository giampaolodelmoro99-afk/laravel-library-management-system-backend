<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Book;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return Author::with('books')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:authors,email']
        ]);

        $author = Author::create($validated);
        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return $author->load(['books']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('authors', 'email')->ignore($author->id)]
        ]);

        $author->update($validated);
        return response()->json($author, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(null, 204);
    }

    public function attachBook(Author $author, Book $book)
    {
        $author->books()->syncWithoutDetaching([$book->id]);
        return response()->json(['message' => 'Book attached to author successfully.']);
    }

    public function detachBook(Author $author, Book $book)
    {
        $author->books()->detach([$book->id]);
        return response()->json(['message' => 'Book detached from author successfully.']);
    }
}
