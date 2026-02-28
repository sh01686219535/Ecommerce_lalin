<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Contact;
use App\Models\Admin\Order;
use App\Models\Admin\Property;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class AdminController extends Controller
{
    //dashboard 
    public function dashboard(){
        $order = Order::count();
        $property = Property::count();
        $contact = Contact::count();
        return view('admin.home.home',compact('order','property','contact'));
    } 
    //login
    public function login(){
        return view('admin.home.login');
    }
    //adminloginSubmit
    public function adminloginStore(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $check = $request->all();
        $data = [
            'email'=>$check['email'],
            'password'=>$check['password'],
        ];
        if(Auth::guard('admin')->attempt($data)){
            ToastMagic::success('Login successfully');
            return redirect()->route('admin.dashboard');
        }else{
            ToastMagic::error('Invalid Credentialsly');
            return redirect()->back();
        }
    }
    // logout
    public function AdminLogout(){
        Auth::guard('admin')->logout();
         ToastMagic::success('Admin Logout Successfully');
        return redirect()->route('home');
    }
    //vendorList
    public function vendorList(){
        $vendor = Vendor::latest()->get();
        return view('admin.vendor.index',compact('vendor'));
    }
    //vendorDelete
    public function vendorDelete($id){
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        ToastMagic::success('Vendor Deleted Successfully');
        return back();
    }
}
