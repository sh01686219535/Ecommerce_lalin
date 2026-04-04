<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use PDF;

class OrderController extends Controller
{
    public function order(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|digits_between:8,15',
            'email' => 'required|email|max:100',
        ]);

        $property = Property::findOrFail($id);
        if (isset($property)) {
            $order = new Order();
            $order->name = $request->name;
            $order->property_id = $property->id;
            $order->vendor_id = $property->vendor_id;
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->message = $request->message;
            $order->save();
            ToastMagic::success('Order Submitted successfully!');
            return back();
        }
    }
    // order index
    public function orderIndex()
    {

        $order = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.order.index', compact('order'));
    }
    //orderDelete
    public function orderDelete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        ToastMagic::success('Order Deleted successfully!');
        return back();
    }
    //orderProperty
    public function orderProduct($id)
    {
        $order = Order::findOrFail($id);
        $product = Product::where('id', $order->product_id)->first();
        $categories = Category::all();
        return view('admin.order.product_details', compact('product', 'categories'));
    }


    public function orderApprove($id)
    {
        $order = Order::with('product')->findOrFail($id);
        $order->status = 'approved';
        $order->save();
        return back();
    }

    // orderPdfdownload
    public function orderPdfdownload($id)
    {
        $order = Order::with('product')->findOrFail($id);
        $pdf = PDF::loadView('admin.order.invoice_pdf', compact('order'));
        return $pdf->download('Invoice_' . $order->id . '.pdf');
    }
    //  Cancel Order
    public function orderCancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancel';
        $order->save();
        ToastMagic::success('Order cancelled and emails sent.!');
        return redirect()->back();
    }
    //orderEdit
    public function orderEdit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }
    //orderUpdate
    public function orderUpdate(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if (!$order) {
            return response('Order not found', 404);
        }
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        if ($request->status == "approved") {
            $order->status = $request->status;
        } elseif ($request->status == "cancel") {
            $order->status = $request->status;
        } elseif ($request->status == 'pending') {
            $order->status = '';
        }
        $order->product_id  = $order->product_id;
        $order->save();
        ToastMagic::info('Order Update successfully!');
        return redirect()->route('admin.order');
    }
}
