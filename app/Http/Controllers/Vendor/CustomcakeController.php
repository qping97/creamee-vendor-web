<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flavor;
use App\Models\Size;
// use Auth;
use Illuminate\Support\Facades\Auth;

class CustomcakeController extends Controller
{
    
    public function getSize(){

        $auth=Auth::guard('vendor')->id();
        $size=Size::where('vendor_id',$auth)->orderBy('id','ASC')->get();
        return view('vendor.custom.size',compact('size'));       
    }

    public function storeSize(Request $request){

        $size= new Size;
        $size->title = $request->input('title');
        $size->price = $request->input('price');
        $size->vendor_id =Auth::guard('vendor')->id();
        $size->save();

        return response()->json(['status'=>true],200);

    }

    public function updateSize(Request $request, $id){

        $size = Size::findorFail($id);

        if(!$size){
            return response()->json(['status' => false],404);
        }
        $size->title = $request->input('title');
        $size->vendor_id= Auth::guard('vendor')->id();
        $size->price = $request->input('price');
        $size->save();

        return response()->json(['status' => true],200);
    }

    public function editSize($id){

        $size = Size::find($id);
     
        return response()->json($size);
    }

    public function destroySize($id){
        $size = Size::find($id);
        $size->delete();  
    }

/*-----------------------*/
    // Flavor
/*-----------------------*/
    public function getFlavor(){

        $auth=Auth::guard('vendor')->id();
        $flavor=Flavor::where('vendor_id',$auth)->orderBy('id','ASC')->get();
        return view('vendor.custom.flavor',compact('flavor'));
    }

    public function storeFlavor(Request $request){

        $flavor= new Flavor;
        $flavor->type = $request->input('type');
        $flavor->price = $request->input('price');
        $flavor->vendor_id =Auth::guard('vendor')->id();
        $flavor->save();

        return response()->json(['status'=>true],200);
    }

    public function updateFlavor(Request $request, $id){

        $flavor = Flavor::findorFail($id);

        if(!$flavor){
            return response()->json(['status' => false],404);
        }
        $flavor->type = $request->input('type');
        $flavor->vendor_id= Auth::guard('vendor')->id();
        $flavor->price = $request->input('price');
        $flavor->save();

        return response()->json(['status' => true],200);
    }

    public function editFlavor($id){

        $flavor = Flavor::find($id);
     
        return response()->json($flavor);
    }

    public function destroyFlavor($id){
        $flavor = Flavor::find($id);
        $flavor->delete();  
    }

}
