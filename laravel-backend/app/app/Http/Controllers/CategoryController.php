<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Book;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::with('books')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_type' => ['required', 'string', 'max:255']
        ]);

        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $category->load(['books']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_type' => ['sometimes', 'string', 'max:255']
        ]);

        $category->update($validated);
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
    public function attachBook(Category $category, Book $book)
    {
        $category->books()->syncWithoutDetaching([$book->id]);
        return response()->json(['message' => 'Book attached to category successfully.']);
    }

    public function detachBook(Category $category, Book $book)
    {
        $category->books()->detach([$book->id]);
        return response()->json(['message' => 'Book detached from category successfully.']);
    }
}
