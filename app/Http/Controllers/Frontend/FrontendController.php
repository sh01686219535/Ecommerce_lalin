<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\ChildCategory;
use App\Models\Admin\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function home(Request $request)
    {


        // Dynamic slider section (last 6 properties)
        $propertySlider = Property::latest()->take(6)->get();

        // Categories
        $category = Category::all();

        // Build property query
        $query = Property::query();

        // Search by title (keyword)
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by Division
        if ($request->filled('division')) {
            $query->where('division', $request->division);
        }

        // Filter by Category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by Size range (optional numeric filter)
        if ($request->filled('min_size') && $request->filled('max_size')) {
            $query->whereBetween('size', [$request->min_size, $request->max_size]);
        } elseif ($request->filled('min_size')) {
            $query->where('size', '>=', $request->min_size);
        } elseif ($request->filled('max_size')) {
            $query->where('size', '<=', $request->max_size);
        }

        // Filter by bedroom count
        if ($request->filled('bed')) {
            $query->where('bedroom', '>=', $request->bed);
        }

        // Filter by price range
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        } elseif ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        } elseif ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Get final result
        $property = $query->orderBy('id', 'desc')->get();
        //menu dynamic
        $categories = Category::with(['subCategories.childCategories'])->get();
        $menu = ChildCategory::with(['category', 'subCategory'])
            ->latest()
            ->get();
        // Return view
        return view('frontend.home.home', compact(
            'category',
            'categories',
            'propertySlider',
            'property',
            'menu'
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
