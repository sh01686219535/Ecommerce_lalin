<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Admin\Property; // Added
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Submit a new order
     */
    public function order(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|digits_between:8,15',
            'email' => 'required|email|max:100',
        ]);

        $property = Property::findOrFail($id);

        $order = new Order();
        $order->name = $request->name;
        $order->property_id = $property->id;
        $order->vendor_id = $property->vendor_id;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->message = $request->message ?? '';
        $order->save();

        ToastMagic::success('Order submitted successfully!');
        return back();
    }

    /**
     * Display list of orders
     */
    public function orderIndex()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Delete an order
     */
    public function orderDelete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        ToastMagic::success('Order deleted successfully!');
        return back();
    }

    /**
     * Show order product details
     */
    public function orderProduct($id)
    {
        $order = Order::findOrFail($id);
        $product = Product::find($order->product_id);
        $categories = Category::all();

        return view('admin.order.product_details', compact('product', 'categories'));
    }

    /**
     * Approve an order
     */
    public function orderApprove($id)
    {
        $order = Order::with('product')->findOrFail($id);
        $order->status = 'approved';
        $order->save();

        ToastMagic::success('Order approved successfully!');
        return back();
    }

    /**
     * Download invoice as PDF with Bangla support
     */
    public function orderPdfdownload($id)
    {
        $order = Order::with('product')->findOrFail($id);

        $pdf = PDF::loadView('admin.order.invoice_pdf', compact('order'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'NotoSansBengali', // Bangla font
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return $pdf->download('Invoice_' . $order->id . '.pdf');
    }

    /**
     * Cancel an order
     */
    public function orderCancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancel';
        $order->save();

        ToastMagic::success('Order cancelled successfully!');
        return back();
    }

    /**
     * Edit an order
     */
    public function orderEdit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update an order
     */
    public function orderUpdate(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;

        // Status handling
        $validStatus = ['approved', 'cancel', 'pending', ''];
        if (in_array($request->status, $validStatus)) {
            $order->status = $request->status === 'pending' ? '' : $request->status;
        }

        $order->save();

        ToastMagic::info('Order updated successfully!');
        return redirect()->route('admin.order');
    }
}