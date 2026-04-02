<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\ChildCategory;
use App\Models\Admin\Product;
use App\Models\Admin\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    // old good 
    // public function home(Request $request)
    // {
    //     session()->forget('cart');
    //     // Fetch hot deal products
    //     $hotDeals = Product::where('status', 1) // active products only
    //         ->whereNotNull('discount_price')   // must have a discount
    //         ->whereColumn('discount_price', '<', 'price') // discount is less than original price
    //         ->latest()
    //         ->get();

    //     $top_selling_Product = Product::where('status', 1)
    //         ->where('is_featured', 'top_selling') // use whereIn for multiple IDs
    //         ->latest()
    //         ->get();
    //     // Mobile Phone
    //     $featured_product = Product::where('status', 1)
    //         ->where('is_featured', 'featured') // use whereIn for multiple IDs
    //         ->latest()
    //         ->get();
    //     // Watch
    //     $most_popular_product = Product::where('status', 1)
    //         ->where('is_featured', 'most_popular') // use whereIn for multiple IDs
    //         ->latest()
    //         ->get();
    //     // Winter Collection
    //     $new_launch_product = Product::where('status', 1)
    //         ->where('is_featured', 'new_launch') // use whereIn for multiple IDs
    //         ->latest()
    //         ->get();
    //     // Regular Product
    //     $regular_product = Product::where('status', 1)
    //         ->latest()
    //         ->get();
    //     // Dynamic slider section (last 6 properties)
    //     $productSlider = Product::latest()->take(6)->get();

    //     $category = Category::all();
    //     //menu dynamic
    //     $categories = Category::with(['subCategories.childCategories'])
    //         ->where('status', 1)
    //         ->get();
    //     $menu = ChildCategory::with(['category', 'subCategory'])
    //         ->latest()
    //         ->get();
    //     $category = Category::all();
    //     // Return view
    //     return view('frontend.home.home', compact(
    //         'category',
    //         'categories',
    //         'productSlider',
    //         'menu',
    //         'hotDeals',
    //         'top_selling_Product',
    //         'featured_product',
    //         'most_popular_product',
    //         'new_launch_product',
    //         'regular_product'
    //     ));
    // }

    // new code but work this code
    public function home(Request $request)
    {
        session()->forget('cart');

        $search = $request->search;

        // 🔥 filter function
        $filter = function ($query) use ($search) {
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('price', 'LIKE', "%{$search}%");
                });
            }
        };

        // ===== PRODUCTS =====
        $hotDeals = Product::where('status', 1)
            ->whereNotNull('discount_price')
            ->whereColumn('discount_price', '<', 'price')
            ->where($filter)
            ->latest()->get();

        $top_selling_Product = Product::where('status', 1)
            ->where('is_featured', 'top_selling')
            ->where($filter)
            ->latest()->get();

        $featured_product = Product::where('status', 1)
            ->where('is_featured', 'featured')
            ->where($filter)
            ->latest()->get();

        $most_popular_product = Product::where('status', 1)
            ->where('is_featured', 'most_popular')
            ->where($filter)
            ->latest()->get();

        $new_launch_product = Product::where('status', 1)
            ->where('is_featured', 'new_launch')
            ->where($filter)
            ->latest()->get();

        $regular_product = Product::where('status', 1)
            ->where($filter)
            ->latest()->get();

        // ===== SLIDER =====
        $productSlider = Product::latest()->take(6)->get();

        // ===== CATEGORY =====
        $categories = Category::with(['subCategories.childCategories'])
            ->where('status', 1)
            ->get();

        $menu = ChildCategory::with(['category', 'subCategory'])->latest()->get();

        return view('frontend.home.home', compact(
            'categories',
            'productSlider',
            'menu',
            'hotDeals',
            'top_selling_Product',
            'featured_product',
            'most_popular_product',
            'new_launch_product',
            'regular_product',
            'search'
        ));
    }

    //frontend login
    public function login()
    {
        return view('frontend.login');
    }
    //vendorLogin

    public function vendorLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // if (isset(Auth::attempt($credentials))) {
        //     // $user = Auth::user();
        //     // if ($user->role == 2) {
        //     //     if ($user->status == 'approved') {
        //     //         return redirect()->intended('dashboard')
        //     //             ->with('success', 'Vendor login successful!');
        //     //     } else {
        //     //         return back()->withErrors(['email' => 'Your registration is pending approval.']);
        //     //     }
        //     // } else {
        //     //     return back()->withErrors(['email' => 'You are not authorized to access this section.']);
        //     // }
        //     return redirect()->intended('dashboard')
        //         ->with('success', 'Vendor login successful!');
        // }
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 2) {
                if ($user->status == 'approved') {
                    return redirect()->intended('dashboard')
                        ->with('success', 'Vendor login successful!');
                } else {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Your registration is pending approval.']);
                }
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'You are not authorized to access this section.']);
            }
        } else {
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }


    //frontend register
    public function register()
    {
        return view('frontend.register');
    }
    //vendorRegister
    public function vendorRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $vendorUser = new User();
        $vendorUser->name = $request->name;
        $vendorUser->email = $request->email;
        $vendorUser->password = $request->password;
        $vendorUser->status = 'pending';
        $vendorUser->role = '2';
        $vendorUser->save();

        //Vendor 
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->authId = $vendorUser->id;
        $vendor->status = 'pending';
        $vendor->save();

        return redirect('/frontend-login');
    }
    //frontend contact
    public function contact()
    {
        return view('frontend.contact');
    }
    //frontend listing
    public function listing()
    {
        $property = Property::orderBy('id', 'desc')->get();
        return view('frontend.listing', compact('property'));
    }
    //frontend howtoWork
    public function howtoWork()
    {
        return view('frontend.howtoWork');
    }
    //userView
    public function userView()
    {
        return view('frontend.home.userLogin');
    }
    //============productSearch=============//
    //     public function productSearch(Request $request)
    //     {
    //         session()->forget('cart');

    //         $search = $request->search;

    //         // If search exists → filter products
    //         if ($search) {

    //             $products = Product::where('name', 'LIKE', "%{$search}%")
    //                 ->orWhere('price', 'LIKE', "%{$search}%")
    //                 ->latest()
    //                 ->get();

    //             return view('frontend.home.home', compact('products', 'search'));
    //         }

    //         // 🔽 Normal homepage (your existing code)
    //         $hotDeals = Product::where('status', 1)
    //             ->whereNotNull('discount_price')
    //             ->whereColumn('discount_price', '<', 'price')
    //             ->latest()->get();

    //         $top_selling_Product = Product::where('status', 1)
    //             ->where('is_featured', 'top_selling')->latest()->get();

    //         $featured_product = Product::where('status', 1)
    //             ->where('is_featured', 'featured')->latest()->get();

    //         $most_popular_product = Product::where('status', 1)
    //             ->where('is_featured', 'most_popular')->latest()->get();

    //         $new_launch_product = Product::where('status', 1)
    //             ->where('is_featured', 'new_launch')->latest()->get();

    //         $regular_product = Product::where('status', 1)->latest()->get();

    //         $productSlider = Product::latest()->take(6)->get();

    //         $categories = Category::with(['subCategories.childCategories'])
    //             ->where('status', 1)->get();

    //         $menu = ChildCategory::with(['category', 'subCategory'])->latest()->get();

    //         return view('frontend.home.home', compact(
    //             'categories',
    //             'productSlider',
    //             'menu',
    //             'hotDeals',
    //             'top_selling_Product',
    //             'featured_product',
    //             'most_popular_product',
    //             'new_launch_product',
    //             'regular_product'
    //         ));
    //     }
}
