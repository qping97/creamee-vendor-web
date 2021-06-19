<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Auth;

class ProductCategoryController extends Controller
{
   
    public function index()
    { 
        $auth=Auth::guard('vendor')->id();
        $category= ProductCategory::where('ven_id',$auth)->get();

        return view('category.index',compact('category'));

    }

    public function store(Request $request)
    {
 
        $file = $request->file('image');
        $upload = false;
        // $filePath = public_path('images');
        $filePath = public_path('storage/category');

        $fileName = '';
        if($file->isValid()){
           
            $fileName = 'category-'.time().".".$file->getClientOriginalExtension();
            if($file->move($filePath,$fileName)){
                $upload= true;
            }
        }

        if($upload && !empty($fileName)){
            $category= new ProductCategory;

            $category->name= $request->input('name');
            $category->image= 'storage/category/'. $fileName;
            $category->ven_id= Auth::guard('vendor')->id();
            $category->save();
            return response()->json(['status'=>true],200);
        }

        return response()->json(['status'=>false],500);
    }

    public function destroy($id)
    {
        // $category = ProductCategory::where('id',$id)->delete();
        $category = ProductCategory::find($id);
        $image_path = public_path().'/'. $category->image;
        unlink($image_path);
        $category->delete();   

        return response()->json(['status' => true],200);

    }


    public function edit($id)
    {
        $category = ProductCategory::find($id);
        
        return response()->json($category);
    }


    public function update(Request $request, $id)
    {
       
        $category = ProductCategory::findorFail($id);
        if(!$category){
            return response()->json(['status' => false],404);
        }

        if($request->hasfile('image')){        
            $filePath = public_path('storage/category');
            $fileName = '';
            $file = $request->file('image');
            if($file->isValid()){

                $fileName = 'category-'.time().".".$file->getClientOriginalExtension();
                if($file->move($filePath,$fileName)){
                    // remove old file
                    unlink(public_path($category->image)); 
                    $category->image= 'storage/category/'. $fileName;  
                }
            }
        }
  
        $category->name=$request->input('name');
        $category->ven_id= Auth::guard('vendor')->id();
        $category->save();
        return response()->json(['status' => true],200);
    }
}
