<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::with(['authors', 'categories'])->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'date' => ['required', 'date']
        ]);

        $book = Book::create($validated);
        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        return response()->json($book->load(['authors', 'categories']), 200);  
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'], // Usato sometimes per flessibilità
            'description' => ['sometimes', 'string'],
            'date' => ['sometimes', 'date']
        ]);

        $book->update($validated);
        return response()->json($book, 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }

    

    public function attachAuthor(Book $book, Author $author)
    {
        $book->authors()->syncWithoutDetaching([$author->id]);
        return response()->json(['message' => 'Author attached successfully.']);
    }

    public function detachAuthor(Book $book, Author $author)
    {
        $book->authors()->detach([$author->id]);
        return response()->json(['message' => 'Author detached successfully.']);
    }

    public function attachCategory(Book $book, Category $category)
    {
        $book->categories()->syncWithoutDetaching([$category->id]);
        return response()->json(['message' => 'Category attached successfully.']);
    }

    public function detachCategory(Book $book, Category $category)
    {
        $book->categories()->detach([$category->id]);
        return response()->json(['message' => 'Category detached successfully.']);
    }
}