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
    public function home(Request $request)
    {

        // Fetch hot deal products
        $hotDeals = Product::where('status', 1) // active products only
            ->whereNotNull('discount_price')   // must have a discount
            ->whereColumn('discount_price', '<', 'price') // discount is less than original price
            ->latest()
            ->get();
        // Categories
        $gadgets_electronics = Category::where('status', 1)
                    ->where('category', 'Gadgets & Electronics')
                    ->pluck('id');
        $mobile_phone = Category::where('status', 1)
                    ->where('category', 'Mobile Phone')
                    ->pluck('id');
        $watch = Category::where('status', 1)
                    ->where('category', 'Watch')
                    ->pluck('id');
        $winter_collection = Category::where('status', 1)
                    ->where('category', 'Winter Collection')
                    ->pluck('id');
        // Gadgets & Electronics
        $product_gadgets_electronics = Product::where('status', 1)
            ->whereIn('category_id', $gadgets_electronics) // use whereIn for multiple IDs
            ->latest()
            ->get();
        // Mobile Phone
        $product_mobile_phone = Product::where('status', 1)
            ->whereIn('category_id', $mobile_phone) // use whereIn for multiple IDs
            ->latest()
            ->get();
        // Watch
        $product_watch = Product::where('status', 1)
            ->whereIn('category_id', $watch) // use whereIn for multiple IDs
            ->latest()
            ->get();
        // Winter Collection
        $product_winter_collection = Product::where('status', 1)
            ->whereIn('category_id', $winter_collection) // use whereIn for multiple IDs
            ->latest()
            ->get();
        // Dynamic slider section (last 6 properties)
        $productSlider = Product::latest()->take(6)->get();

       
        $category = Category::all(); 
        //menu dynamic
        $categories = Category::with(['subCategories.childCategories'])
            ->where('status', 1)
            ->get();
        $menu = ChildCategory::with(['category', 'subCategory'])
            ->latest()
            ->get();
        $category = Category::all(); 
        // Return view
        return view('frontend.home.home', compact(
            'category',
            'categories',
            'productSlider',
            'menu',
            'hotDeals',
            'product_gadgets_electronics',
            'product_mobile_phone',
            'product_watch',
            'product_winter_collection'
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
}
