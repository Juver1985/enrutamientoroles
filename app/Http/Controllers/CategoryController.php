<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $category = Category::all(); // Variable para el Foreach
        return view('admin.category.index', compact('category')); // Redirecciona a la vista Listado
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
            // Logic to show form for creating a new supplier
         return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = new Category();
        $category->category_name = $request->post('category_name');
        $category->description  = $request->post('description');
        $category->save();

       return redirect()->route('admin.category.create')
                ->with('success', 'Categoría creada exitosamente.');



    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
