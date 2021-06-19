<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Input;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $auth=Auth::guard('vendor')->id();
        $category=ProductCategory::where('ven_id',$auth)->orderBy('id','ASC')->select('id','name as name')->get();
        $product=Product::with('category')->where('vendor_id',$auth)->orderBy('id','ASC')->get();
        
        return view('vendor.product.index')
                ->with('product',$product)
                ->with('category',$category);
         
    }

    public function store(Request $request)
    {
       
        $file = $request->file('product_img');
        $upload = false;
        $filePath = public_path('storage/product');
        $fileName = '';
        if($file->isValid()){
           
            $fileName = 'product-'.time().".".$file->getClientOriginalExtension();
            if($file->move($filePath,$fileName)){
                $upload= true;
            }
        }
        
        if($upload && !empty($fileName)){
        $product= new Product;
        $product->product_category_id = $request->input('product_category_id');
        $product->name = $request->input('name');
        $product->product_img= 'storage/product/'. $fileName;
        $product->product_price = $request->input('product_price');
        $product->description = $request->input('description'); 
        $product->vendor_id =Auth::guard('vendor')->id();
        $product->save();
        return response()->json(['status'=>true],200);
        }
        return response()->json(['status'=>false],500);
    }

    public function destroy($id)
    {
        // $product = Product::where('id',$id)->delete();
        $product = Product::find($id);
        $image_path = public_path().'/'. $product->product_img;
        unlink($image_path);
        $product->delete();  

        return response()->json(['status' => true],200);
    }


    public function edit($id)
    {
        $product = Product::find($id);
        
        return response()->json($product);
    }


    public function update(Request $request, $id)
    {
        $product = Product::findorFail($id);
        if(!$product){
            return response()->json(['status' => false],404);
        }

        if($request->hasfile('product_img')){        
            $filePath = public_path('storage/product');
            $fileName = '';
            $file = $request->file('product_img');
            if($file->isValid()){

                $fileName = 'product-'.time().".".$file->getClientOriginalExtension();
                if($file->move($filePath,$fileName)){
                    // remove old file
                    unlink(public_path($product->product_img)); 
                    $product->product_img= 'storage/product/'. $fileName;  
                }
            }
        }
  
        $product->name=$request->input('name');
        $product->vendor_id= Auth::guard('vendor')->id();
        $product->product_category_id = $request->input('product_category_id');
        $product->product_price = $request->input('product_price');
        $product->description = $request->input('description'); 
        $product->save();
        return response()->json(['status' => true],200);
    }

}
