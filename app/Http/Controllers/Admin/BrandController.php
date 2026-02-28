<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::latest()->get();
        return view('admin.brand.index', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        // * Single Image Upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $imageName = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('BrandImages'), $imageName);
            $brand->logo = 'BrandImages/' . $imageName;
        }
        $brand->status = $request->status;
        $brand->save();
        ToastMagic::success('Brand Created Successfully');
        return redirect()->route('brand.index');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        // * Single Image Upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $imageName = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('BrandImages'), $imageName);
            $brand->logo = 'BrandImages/' . $imageName;
        }
        $brand->status = $request->status;
        $brand->save();
        ToastMagic::success('Brand Created Successfully');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        if (!empty($brand->logo)) {
            $imagePath = public_path($brand->logo);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $brand->delete();

        ToastMagic::info('Brand Deleted Successfully');
        return back();
    }
}
