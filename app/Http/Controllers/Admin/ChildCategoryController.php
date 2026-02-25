<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\ChildCategory;
use App\Models\Subcategory;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $childCategories = ChildCategory::with('category', 'subCategory')->latest()->get();
        return view('admin.childCategory.index', compact('childCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $sunCategories = Subcategory::latest()->get();
        return view('admin.childCategory.create', compact('categories', 'sunCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_category' => 'required',
            'category_id' => 'required',
            'subCategory_id' => 'required'
        ]);
        $childCategory = new ChildCategory();
        $childCategory->child_category = $request->child_category;
        $childCategory->category_id = $request->category_id;
        $childCategory->subCategory_id = $request->subCategory_id;
        $childCategory->save();
        ToastMagic::success('Child Category Created successfully!');
        return redirect()->route('childCategory.index');
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
        $childCategory = ChildCategory::findOrFail($id);
        $categories = Category::latest()->get();

        // Only fetch subcategories for the currently selected category
        $subCategories = Subcategory::where('category_id', $childCategory->category_id)->get();

        return view('admin.childCategory.edit', compact('childCategory', 'categories', 'subCategories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'child_category' => 'required',
            'category_id' => 'required',
            'subCategory_id' => 'required'
        ]);
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->child_category = $request->child_category;
        $childCategory->category_id = $request->category_id;
        $childCategory->subCategory_id = $request->subCategory_id;
        $childCategory->save();
        ToastMagic::success('Child Category Updated successfully!');
        return redirect()->route('childCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();
        ToastMagic::info('Child Category Deleted Successfully');
        return back();
    }
}
