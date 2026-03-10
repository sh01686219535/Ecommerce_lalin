<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
            $cart[$id]['total_price'] = $cart[$id]['qty'] * $cart[$id]['price'];
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'qty' => 1,
                'total_price' => $product->price
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'cartCount' => array_sum(array_column($cart, 'qty')),
            'cartTotal' => array_sum(array_column($cart, 'total_price'))
        ]);
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'cartCount' => array_sum(array_column($cart, 'qty') ?: []),
            'cartTotal' => array_sum(array_column($cart, 'total_price') ?: [])
        ]);
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['qty'] = $request->qty;
            $cart[$id]['total_price'] = $cart[$id]['price'] * $request->qty;
            session()->put('cart', $cart);
        }

        return response()->json([
            'qty' => $cart[$id]['qty'],
            'total_price' => $cart[$id]['total_price'],
            'cartCount' => array_sum(array_column($cart, 'qty')),
            'cartTotal' => array_sum(array_column($cart, 'total_price'))
        ]);
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $cartTotal = array_sum(array_column($cart, 'total_price'));
        return view('frontend.cart.order', compact('cart', 'cartTotal'));
    }
}
