<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\ChildCategory;
use App\Models\Admin\Product;
use App\Models\Subcategory;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('brand', 'category', 'subCategory', 'childCategory')->latest()->get();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = Brand::latest()->get();
        $categories = Category::latest()->get();
        $sunCategories = Subcategory::with('category')->latest()->get();
        $childCategories = ChildCategory::with('category', 'subCategory')->latest()->get();

        return view('admin.product.create', compact('brand', 'categories', 'sunCategories', 'childCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'multi_image.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_price_percentage = $request->discount_price_percentage;

        // Calculate Discount
        if ($request->filled('discount_price_percentage')) {
            $discountAmount = ($request->price * $request->discount_price_percentage) / 100;
            $product->discount_price = $request->price - $discountAmount;
        } elseif ($request->filled('discount_price')) {
            $product->discount_price = $request->discount_price;
        }

        // Multiple Fields (Tagify auto sends JSON string)
        $product->tag = $request->tag ? json_decode($request->tag, true) : null;
        $product->color = $request->color ? json_decode($request->color, true) : null;
        $product->size = $request->size ? json_decode($request->size, true) : null;

        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;

        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->video_url = $request->video_url;
        $product->is_featured = $request->is_featured ? 1 : 0;

        // Single Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProductImages'), $imageName);
            $product->image = 'ProductImages/' . $imageName;
        }

        // Multiple Image
        if ($request->hasFile('multi_image')) {
            $multiImages = [];

            foreach ($request->file('multi_image') as $multi) {
                $multiName = uniqid() . '.' . $multi->getClientOriginalExtension();
                $multi->move(public_path('ProductMultiImages'), $multiName);
                $multiImages[] = 'ProductMultiImages/' . $multiName;
            }

            $product->multi_image = $multiImages;
        }

        $product->save();

        ToastMagic::success('Product Added Successfully');
        return redirect()->route('product.index');
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
        $product = Product::findOrFail($id);
        $brand = Brand::latest()->get();
        $categories = Category::latest()->get();
        $sunCategories = Subcategory::with('category')->latest()->get();
        $childCategories = ChildCategory::with('category', 'subCategory')->latest()->get();

        return view('admin.product.edit', compact('product', 'brand', 'categories', 'sunCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'multi_image.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_price_percentage = $request->discount_price_percentage;

        // Calculate Discount
        if ($request->filled('discount_price_percentage')) {
            $discountAmount = ($request->price * $request->discount_price_percentage) / 100;
            $product->discount_price = $request->price - $discountAmount;
        } elseif ($request->filled('discount_price')) {
            $product->discount_price = $request->discount_price;
        }

        // Multiple Fields (Tagify auto sends JSON string)
        $product->tag = $request->tag ? json_decode($request->tag, true) : null;
        $product->color = $request->color ? json_decode($request->color, true) : null;
        $product->size = $request->size ? json_decode($request->size, true) : null;

        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;

        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->video_url = $request->video_url;
        $product->is_featured = $request->is_featured ? 1 : 0;

        /***********************
         * Single Image Upload
         * Delete old image if exists
         ***********************/
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProductImages'), $imageName);
            $product->image = 'ProductImages/' . $imageName;
        }

        /***********************
         * Multiple Image Upload
         * Delete old images if exist
         ***********************/
        if ($request->hasFile('multi_image')) {

            // Delete old multiple images
            if ($product->multi_image) {
                $oldMulti = is_array($product->multi_image) ? $product->multi_image : json_decode($product->multi_image, true);
                if ($oldMulti) {
                    foreach ($oldMulti as $oldImg) {
                        if (file_exists(public_path($oldImg))) {
                            unlink(public_path($oldImg));
                        }
                    }
                }
            }

            // Upload new images
            $multiImages = [];
            foreach ($request->file('multi_image') as $multi) {
                $multiName = uniqid() . '.' . $multi->getClientOriginalExtension();
                $multi->move(public_path('ProductMultiImages'), $multiName);
                $multiImages[] = 'ProductMultiImages/' . $multiName;
            }
            $product->multi_image = $multiImages;
        }

        $product->save();

        ToastMagic::success('Product Updated Successfully');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete single image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Delete multiple images
        if ($product->multi_image) {
            $multiImages = is_array($product->multi_image) ? $product->multi_image : json_decode($product->multi_image, true);
            if ($multiImages) {
                foreach ($multiImages as $img) {
                    if (file_exists(public_path($img))) {
                        unlink(public_path($img));
                    }
                }
            }
        }

        // Delete product
        $product->delete();

        ToastMagic::info('Product Deleted Successfully');
        return back();
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
