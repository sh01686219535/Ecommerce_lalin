<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function order($id)
    {
        $cart = session()->get('cart', []); // Get everything in session
        $cartTotal = array_sum(array_column($cart, 'total_price'));
        $products = Product::with('category', 'subCategory', 'childCategory', 'brand')->findOrFail($id);
        return view('frontend.order.index', compact('products', 'cart', 'cartTotal'));
    }
    //userOrder
    public function userOrder(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required',
        ]);

        $product = Product::findOrFail($id);

        $qty = $request->quantity;
        $delivery = $request->delivary_charge;

        $total = ($product->price * $qty) + $delivery;
        $order = new Order();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->quantity = $qty;
        $order->delivary_charge = $delivery;
        $order->total_price = $total;
        $order->product_id = $product->id;
        $order->save();
        ToastMagic::success('Order placed successfully');
        return redirect()->route('home');
    }
}
