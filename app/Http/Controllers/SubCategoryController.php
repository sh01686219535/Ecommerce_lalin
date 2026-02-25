<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Subcategory;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = Subcategory::with('category')->latest()->get();
        return view('admin.subCategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.subCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sub_category' => 'required|max:100',
            'category_id' => 'required|max:100',
        ]);
        $subCategory = new Subcategory();
        $subCategory->sub_category = $request->sub_category;
        $subCategory->category_id = $request->category_id;
        $subCategory->save();
        ToastMagic::success('Sub Category Created successfully!');
        return redirect()->route('subCategory.index');
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
        $subCategory = Subcategory::findOrFail($id);
        $categories = Category::latest()->get();
        return view('admin.subCategory.edit', compact('subCategory', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sub_category' => 'required|max:100',
            'category_id' => 'required|max:100',
        ]);
        $subCategory = Subcategory::findOrFail($id);
        $subCategory->sub_category = $request->sub_category;
        $subCategory->category_id = $request->category_id;
        $subCategory->save();
        ToastMagic::success('Sub Category Updated successfully!');
        return redirect()->route('subCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = Subcategory::findOrFail($id);
        $subCategory->delete();
        ToastMagic::info('Sub Category Deleted successfully!');
        return back();
    }
    public function getSubCategory($category_id)
    {
        $subCategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subCategories);
    }
}
