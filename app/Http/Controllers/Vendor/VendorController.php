<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Order;
use App\Models\CustomCake;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    public function getprofile(){

        $auth=Auth::guard('vendor')->id();

        $vendor=Vendor::where('id',$auth)->first();

        return view('vendor.profile',compact('vendor'));

    }

    public function updateProfile(Request $request){
        $auth=Auth::guard('vendor')->id();
        $vendor=Vendor::findOrFail($auth);
    
        if (!empty($request['password'])) {
            $vendor['password'] =bcrypt($request['password']);
        }
        if($request->hasfile('image')){       
            $file = $request->file('image'); 
            $fileproPath = public_path('storage/vendor');
            $fileName = '';
            if($file->isValid()){

                $fileName = 'vendor-'.time().".".$file->getClientOriginalExtension();
                if($file->move($fileproPath,$fileName))
                {
                    // remove old file
                    // unlink(public_path($vendor->image)); 
                    $vendor['image']= 'storage/vendor/'. $fileName;  
                }
            }
        }

        if($request->hasfile('profile_img')){        
            $filePath = public_path('storage/profile_pic/vendor');
            $fileName = '';
            $fileprofile = $request->file('profile_img');
            if($fileprofile->isValid()){

                $fileName = 'profile-'.time().".".$fileprofile->getClientOriginalExtension();
                if($fileprofile->move($filePath,$fileName)){
                    // remove old file
                    // unlink(public_path($vendor->profile_img)); 
                    $vendor['profile_img']= 'storage/profile_pic/vendor/'. $fileName;  
                }
            }
        }

        $vendor['vendor_name']=$request->input('vendor_name');
       
        $vendor['contact_no']=$request->input('contact_no');
        $vendor['vendor_address']=$request->input('vendor_address');
       
        $vendor->update();
        session()->flash('profile',true);
        return redirect()->back()->with('status','Profile Updated');
    }

    public function orders(){
        $auth=Auth::guard('vendor')->id();
        $order=Order::with('customer')->where('vendor_id',$auth)->orderBy('created_at','DESC')->get();
        return view('vendor.order',compact('order'));

    }
    
    public function getOrderDetails($id){ 
        $order=Order::with('customer')->find($id);

        $product=$order->with('product')->get();

        return view('vendor.orderdetails',compact('order','product'));

    }

    public function updateOrderStatus(Request $request,$orderId){
       
        Order::where('id',$orderId)->update(['order_status'=>$request->order_status]);
        session()->flash('status',true);
        return redirect("vendor/order-details/$orderId");
        
    }

    public function dashboard(){

        $auth=Auth::guard('vendor')->id();
        $product=Product::where('vendor_id',$auth)->count();
        
        $order=Order::where('vendor_id',$auth)->count();

        $earning=Order::where('vendor_id',$auth)->get();
        $sum=0.00;
        foreach ($earning as $e){
            $sum+=$e->amount;
        }
       $total= number_format($sum, 2, ".", "");

        return view('vendor.dashboard',compact('product','order','total'));
    }

    public function customOrders(){
        $auth=Auth::guard('vendor')->id();
        $custom=CustomCake::with('customers','sizes','flavors')->where('vendor_id',$auth)->orderBy('created_at','ASC')->get();

        return view('vendor.custom.customorder',compact('custom'));
    }

    public function getcustomDetail($id){
        $customorder=CustomCake::with('flavors','sizes','customers')->find($id);
        return view('vendor.custom.customdetail',compact('customorder'));

    }

    
}
