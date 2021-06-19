<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Admin;


class AdminController extends Controller
{
    public function index()
    {
        $vendor=Vendor::count();
        $customer=Customer::count();
        return view('admin.dashboard',compact('vendor','customer'));
    }

    public function customer()
    {
        $customer= Customer::all();

        return view('admin.customerlist',compact('customer'));
    }

    public function getCustomer($id)
    {
        $customer= Customer::find($id);

        return response()->json($customer);
    }

    public function vendor()
    {
        
        $vendor= Vendor::all();

        // dd($vendor);// based on is blocked we show blocked or unblocked message

        return view('admin.vendorlist',compact('vendor'));
    }

    public function getVendor($id)
    {
        $vendors= Vendor::find($id);

        return response()->json($vendors);
    }

    public function getprofile()
    {
        $admin=Admin::first();
   
        return view('admin.profile',compact('admin'));
    }
    
    public function updateAdminprofile(Request $request)
    {
        $admin=Admin::first();
      if (!empty($request['password'])) {
        // $vendor['password']=bcrypt($request['password']);
        $admin['password'] =bcrypt($request['password']);
        // dd($admin['password']);
    }
    $admin->update();

      return redirect()->back()->with('status','Profile Updated');
   
    }
    public function vendorIsBlocked($id,$val){

        $vendor = Vendor::find($id);
        $vendor->isblock = !$vendor->isblock;
        $vendor->save();
        return response()->json(true);
    }

    
}    
