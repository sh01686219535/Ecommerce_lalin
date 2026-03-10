<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //    public function order(Request $request, $id)
    //     {
    //         $userId = Auth::guard('user')->user()->id;
    //         $request->validate([
    //             'name' => 'required|string|max:100',
    //             'phone' => 'required|digits_between:8,15',
    //             'email' => 'required|email|max:100',
    //         ]);

    //         $property = Property::findOrFail($id);
    //         if (isset($property)) {
    //             $order = new Order();
    //             $order->name = $request->name;
    //             $order->property_id = $property->id;
    //             $order->vendor_id = $property->vendor_id;
    //             $order->user_id = $userId;
    //             $order->phone = $request->phone;
    //             $order->email = $request->email;
    //             $order->message = $request->message;
    //             $order->save();
    //             return back();
    //         }
    //     }
    public function order($id)
    {
        $cart = session()->get('cart', []); // Get everything in session
        $cartTotal = array_sum(array_column($cart, 'total_price'));
        $products = Product::with('category', 'subCategory', 'childCategory', 'brand')->findOrFail($id);
        return view('frontend.order.index', compact('products','cart', 'cartTotal'));
    }
}
