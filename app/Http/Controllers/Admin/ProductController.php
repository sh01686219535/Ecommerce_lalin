<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\ChildCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $sunCategories = Subcategory::with('category')->latest()->get();
        $childCategories = ChildCategory::with('category', 'subCategory')->latest()->get();

        return view('admin.product.create', compact('categories', 'sunCategories', 'childCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    public function getChildCategories($subcategory_id)
    {
        $childcategories = ChildCategory::where('subcategory_id', $subcategory_id)->get();
        return response()->json($childcategories);
    }
}
