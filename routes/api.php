<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\VendorController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Vendor;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Size;
use App\Models\Flavor;
use App\Models\Cart;
use App\Models\Order;
use App\Models\CustomCake;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('register/customer', 'Auth\RegisterController@createCustomer')->name('customerLogin');

Route::post('/login/customer', [LoginController::class, 'customerLogin']);
Route::post('/register/customer', function (Request $request) {
    try {
        $files=$request->file('profile_pic');
            $filePath = public_path('storage/profile_pic/customer');
            $fileName = '';
            foreach($files as $file){
                if ($file->isValid()) {
                $file->getClientOriginalName();   
                $fileName = 'customer-' . time() . "." . $file->getClientOriginalExtension();
                        $file->move($filePath, $fileName);
                }}
        
            $cus = new Customer; 

            $cus->name = $request->input('name');
            $cus->contact_no = $request->input('contact_no');
            $cus->address = $request->input('address');
            $cus->email = $request->input('email');
            $cus->profile_pic='storage/profile_pic/customer/'. $fileName;        
            $cus->password = bcrypt($request->input('password'));
            $cus->longitude = $request->input('longitude');
            $cus->latitude =$request->input('latitude');
        $cus->save();

        return response()->json([
            'customer' => $cus,
            'success' => true,
            'message' => 'success!'
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
    }
});

Route::get('/customer/profile/{id}', function ($customerID) {
    try {
        $customer = Customer::where('id', $customerID)->first();
        return response()->json([
            'customer' => $customer,
            'success' => true,
            'message' => 'success!'
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
    }
});
//customer edit account
Route::post('/customer/profile/{id}/edit', function (Request $request, $customerID) {
    try {
        $cus = Customer::findorFail($customerID);

        if (!empty($request['password'])) {
            $cus['password'] =bcrypt($request['password']);

        }

        if($request->hasfile('profile_pic')){
            $files=$request->hasfile('profile_pic');
            $filePath = public_path('storage/profile_pic/customer');
            $fileName = '';
            foreach($files as $file){
                if ($file->isValid()) {

                    $file->getClientOriginalName();
                    $fileName = 'customer-' . time() . "." . $file->getClientOriginalExtension();
                    $file->move($filePath, $fileName);
                }

            }
            $cus->profile_pic='storage/profile_pic/customer/'. $fileName;
        }
        // if($request->hasfile('profile_pic')){
        // $file=$request->file("profile_pic");
        // $filePath = public_path('storage/profile_pic/customer');
        // $fileName = '';
        
        // if ($file->isValid()) {

        //     $fileName = 'customer-' . time() . "." . $file->getClientOriginalExtension();
        //     $file->move($filePath, $fileName);
        //  }
        //  $cus->profile_pic='storage/profile_pic/customer/'. $fileName;

        // }
            $cus->name = $request->name;
            $cus->contact_no = $request->contact_no;
            $cus->address = $request->address;
            
            $cus->longitude = $request->longitude;
            $cus->latitude = $request->latitude;
            

            $cus->update();
        

        return response()->json([
            'customer' => $cus,
            'success' => true,
            'message' => 'success!'
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        return response()->json([
            'message' =>  $e->getMessage()
        ]);
    }
});

Route::get('/vendors', function (Request $request) {
    try {
        
        $lat=$request->latitude;//user latitude
        $long=$request->longitude; //user longitude
        $vendors = Vendor::all();
       
        return response()->json([
            // 'distance'=>$distance,
            'data' => $vendors,
            'success' => true,
            'message' => 'success!'
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
    }
});
Route::get('/category-list/{id}', function ($vendorID) {
    try {
        $vendors = Vendor::where('id', $vendorID)->first();
        $category = ProductCategory::whereHas('vendors', function ($q) use ($vendorID) {
            $q->where('ven_id', $vendorID);
        })
            ->get();
        return response()->json([
            'category' => $category,
            'success' => true,
            'message' => 'success!'
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
    }
});

Route::get('/category-list/{vendorID}/{categoryID}/productlist', function (Request $request, $vendorID, $categoryID) {
    try {
        $vendor = Vendor::where('id', $vendorID)->first();
        $productlist = Product::where('product_category_id', $categoryID)->get();
        return response()->json([
            'productlist' => $productlist,
            'vendor' => $vendor,
            'success' => true,
            'message' => 'success!'
        ]);
        // return response()->json(['message' => 'sucess', 'productlist' => $categoryID, 'vendor'=> $vendor, 'success'=>true]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
    }
});

Route::get('/getcustom/{id}', function ($vendorID) {
    try {
        $vendor = Vendor::where('id', $vendorID)->first();

        $getSize = Size::whereHas('vendors', function ($q) use ($vendorID) {
            $q->where('vendor_id', $vendorID);
        })->get();

        $getFlavor = Flavor::whereHas('vendorsflavor', function ($a) use ($vendorID) {
            $a->where('vendor_id', $vendorID);
        })->get();

        return response()->json([
            'getsize' => $getSize,
            'getflavor' => $getFlavor,
            'success' => true,
            'message' => 'success!'
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
    }
});

Route::post('/addtocart', function (Request $request) {
    function getCartItem($customerId)
    {
        try {

            $allCartItems = Cart::where([
                'customer_id' => $customerId
            ])->get()->map(function ($instance) {
                $product = Product::find($instance->product_id);
                $instance->product = $product;
                $instance->quantity = 1;
                return $instance;
            })->toArray();

            $subTotal = array_reduce($allCartItems, function ($acc, $instance) {
                return $acc + $instance['product']['product_price'];
            }, 0);

            $mergedArr = [];

            foreach ($allCartItems as $key => $instance) {
                // $filter = function ($item) use ($instance) {
                //     return $item['product_id'] == $instance['product_id'];
                // };

                // $existingItem = array_filter($mergedArr, $filter);
                $existingItem = [];

                foreach ($mergedArr as $i => $item) {
                    if ($item['product_id'] == $instance['product_id']) {
                        array_push($existingItem, $item);
                    }
                }

                if (!empty($existingItem)) {

                    $index = 0;

                    foreach ($mergedArr as $key => $item) {
                        if ((int) $item['product_id'] === (int) $existingItem[0]['product_id']) {
                            $index = $key;
                            break;
                        }
                    }

                    $mergedArr[$index]['quantity'] = $mergedArr[$index]['quantity'] + 1;
                    // $mergedArr[sizeof($mergedArr) - 1]['quantity'] = $mergedArr[sizeof($mergedArr) - 1]['quantity'] + 1;
                } else {
                    array_push($mergedArr, $instance);
                }
            }

            $payload = (object)[];
            $payload->products = $mergedArr;
            $payload->subTotal = $subTotal;

            return  $payload;
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }
    try {
        $customerId = $request->customer_id; 
        $productId = $request->product_id;

        $product = Product::find($productId);
        $existingCart = Cart::where(['customer_id' => $customerId])->first();

        if ($existingCart) {
            $vendorId = $existingCart->product->vendor->id;

            if ($product->vendor->id !== $vendorId) {
                throw new Exception('You cannot add product from different vendor.');
            }
        }

        Cart::create([
            'product_id' => $productId,
            'customer_id' => $customerId
        ]);

        $payload = getCartItem($customerId);

        return response()->json([
            'success' => true,
            'message' => 'success!',
            'payload' => $payload
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        throw $e;
    }
});

Route::get('/get-cart/{customerId}', function (Request $req, $customerId) {
    try {
        function getCartItem($customerId)
        {
            try {
    
                $allCartItems = Cart::where([
                    'customer_id' => $customerId
                ])->get()->map(function ($instance) {
                    $product = Product::find($instance->product_id);
                    $instance->product = $product;
                    $instance->quantity = 1;
                    return $instance;
                })->toArray();
    
                $subTotal = array_reduce($allCartItems, function ($acc, $instance) {
                    return $acc + $instance['product']['product_price'];
                }, 0);
    
                $mergedArr = [];
    
                foreach ($allCartItems as $key => $instance) {
                    // $filter = function ($item) use ($instance) {
                    //     return $item['product_id'] == $instance['product_id'];
                    // };

    
                    // $existingItem = array_filter($mergedArr, $filter);
                    $existingItem = [];
    

                    // $existingItem = array_filter($mergedArr, $filter);
                    $existingItem = [];
                    foreach ($mergedArr as $i => $item) {
                        if ($item['product_id'] == $instance['product_id']) {
                            array_push($existingItem, $item);
                        }
                    }


                    if (!empty($existingItem)) {

                        $index = 0;

                        foreach ($mergedArr as $key => $item) {
                            if ((int) $item['product_id'] === (int) $existingItem[0]['product_id']) {
                                $index = $key;
                                break;
                            }
                        }

                        $mergedArr[$index]['quantity'] = $mergedArr[$index]['quantity'] + 1;
                        // $mergedArr[sizeof($mergedArr) - 1]['quantity'] = $mergedArr[sizeof($mergedArr) - 1]['quantity'] + 1;
                    } else {
                        array_push($mergedArr, $instance);
                    }
                }
    
                $payload = (object)[];
                $payload->products = $mergedArr;
                $payload->subTotal = $subTotal;
    
                return  $payload;
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                throw $e;
            }
        }
        $payload = getCartItem($customerId);

        return response()->json([
            'success' => true,
            'message' => 'success!',
            'payload' => $payload,
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        throw $e;
    }
});

Route::post('/checkout', function (Request $req) {

    try {
        function getCartItem($customerId)
        {
            try {
    
                $allCartItems = Cart::where([
                    'customer_id' => $customerId
                ])->get()->map(function ($instance) {
                    $product = Product::find($instance->product_id);
                    $instance->product = $product;
                    $instance->quantity = 1;
                    return $instance;
                })->toArray();
    
                $subTotal = array_reduce($allCartItems, function ($acc, $instance) {
                    return $acc + $instance['product']['product_price'];
                }, 0);
    
                $mergedArr = [];
    
                foreach ($allCartItems as $key => $instance) {
                    // $filter = function ($item) use ($instance) {
                    //     return $item['product_id'] == $instance['product_id'];
                    // };
    
                    // $existingItem = array_filter($mergedArr, $filter);
                    $existingItem = [];
    
                    foreach ($mergedArr as $i => $item) {
                        if ($item['product_id'] == $instance['product_id']) {
                            array_push($existingItem, $item);
                        }
                    }
    
                    if (!empty($existingItem)) {
    
                        $index = 0;
    
                        foreach ($mergedArr as $key => $item) {
                            if ((int) $item['product_id'] === (int) $existingItem[0]['product_id']) {
                                $index = $key;
                                break;
                            }
                        }
    
                        $mergedArr[$index]['quantity'] = $mergedArr[$index]['quantity'] + 1;
                        // $mergedArr[sizeof($mergedArr) - 1]['quantity'] = $mergedArr[sizeof($mergedArr) - 1]['quantity'] + 1;
                        
                  
                    } else {
                        array_push($mergedArr, $instance);
                    }
                }
    
                $payload = (object)[];
                $payload->products = $mergedArr;
                $payload->subTotal = $subTotal;
    
                return  $payload;
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                throw $e;
            }
        }
        $customerId = $req->customer_id;

        $customer = Customer::find($customerId);

        $cart = getCartItem($customerId);
        $cart->deliveryFee = number_format(5, 2, '.', '');
        $cart->total = number_format($cart->deliveryFee + $cart->subTotal, 2, '.', '');
        $cart->subTotal = number_format($cart->subTotal, 2, '.', '');

        return response()->json([
            'message' => 'success',
            'payload' => [
                'customer' => $customer,
                'cart' => $cart
            ]
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        throw $e;
    }
});

Route::get('/getVendor/{id}', function(Request $request, $vendorId){
    try {      

    // $vendorId=$request->vendor_id;
    // $vendor=Vendor::find($vendorId);
    $getVendor=Vendor::where('id',$vendorId)->first();
    return response()->json([
        'message' => 'success',
        'vendor' =>$getVendor,
       
    ]);
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
}
});
Route::post('/placeorder', function (Request $request) {
    try {

        // $customerId = $request->input('customer_id');
        // $customer = Customer::find($customerId);      
        // $cart = getCartItem($customerId);
// $countcart=Cart::where('customer_id',$customerId)->notDistinct()->orderBy('product_id')->count();
// return  response()->json([
//     // 'message'=>'false',
    
//     'message' =>  "fdsfgdsg",
   
// ]);
        $saveorder = $request->validate([
            'customer_id'=> 'required',
            'vendor_id'=>'required',
            // 'order_date'=>'required',
            'pickup_date'=>'required',
            // 'order_status'=>'required',
            'shipping_address'=>'required',
            'amount'=>'required',
            'delivery_method'=>'required',
            // 'delievery_fee'=>'required',
            'order_notes'=>'required',
        ]);
        

        // $saveorder= new Order;
        $saveorder['customer_id'] = $request->input('customer_id');
        $saveorder['vendor_id'] = $request->input('vendor_id');
        $saveorder['order_date']= Carbon::now()->isoFormat('YYYY-MM-DD');
        $saveorder['pickup_date']=\Carbon\Carbon::parse($request->input('pickup_date'))->format('Y-m-d');
        $saveorder['order_status']="Pending";
        $saveorder['shipping_address']=$request->input('shipping_address');
        $saveorder['amount']=$request->input('amount');
        $saveorder['payment']=$request->input('payment');
        $saveorder['delivery_method']=$request->input('delivery_method');
        $saveorder['delivery_fee']=5;
        $saveorder['order_notes']=$request->input('order_notes');
        $newOrder=Order::create($saveorder);
       
         $instanceOrder=$newOrder->id;

         $getOrder=Order::find($instanceOrder);

        // dd($getOrder->product());

        $countcart= DB::table('cart') 
        ->select('product_id',DB::raw('COUNT(product_id) as quantity'))
        ->where('customer_id',$newOrder->customer_id)
        ->groupBy('product_id')
        ->orderBy('quantity')
        ->get();
        // dd($countcart);
       
        foreach($countcart as $index=>$item){

        $getOrder->product()->attach($instanceOrder, [
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
        ]);

        }

        $getCart=Cart::where('customer_id',$request->customer_id)->get();
        Cart::destroy($getCart);

        return response()->json([
            'message' => 'success',
            // 'countcart'=>$countcart
            // 'order'=> $saveorder,
            // 'payload' => [
            //     'customer' => $customer,
            //     'cart' => $cart
            // ]
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        return  response()->json([
            // 'message'=>'false',
            'date'=>\Carbon\Carbon::parse($request->input('pickup_date'))->format('Y-m-d'),
            'message' =>  $e->getMessage(),
           
        ]);
    }
});

Route::patch('/update-quantity', function (Request $req) {
    function getCartItem($customerId)
    {
        try {

            $allCartItems = Cart::where([
                'customer_id' => $customerId
            ])->get()->map(function ($instance) {
                $product = Product::find($instance->product_id);
                $instance->product = $product;
                $instance->quantity = 1;
                return $instance;
            })->toArray();

            $subTotal = array_reduce($allCartItems, function ($acc, $instance) {
                return $acc + $instance['product']['product_price'];
            }, 0);

            $mergedArr = [];

            foreach ($allCartItems as $key => $instance) {
                // $filter = function ($item) use ($instance) {
                //     return $item['product_id'] == $instance['product_id'];
                // };

                // $existingItem = array_filter($mergedArr, $filter);
                $existingItem = [];

                foreach ($mergedArr as $i => $item) {
                    if ($item['product_id'] == $instance['product_id']) {
                        array_push($existingItem, $item);
                    }
                }

                if (!empty($existingItem)) {

                    $index = 0;

                    foreach ($mergedArr as $key => $item) {
                        if ((int) $item['product_id'] === (int) $existingItem[0]['product_id']) {
                            $index = $key;
                            break;
                        }
                    }

                    $mergedArr[$index]['quantity'] = $mergedArr[$index]['quantity'] + 1;
                    // $mergedArr[sizeof($mergedArr) - 1]['quantity'] = $mergedArr[sizeof($mergedArr) - 1]['quantity'] + 1;
                } else {
                    array_push($mergedArr, $instance);
                }
            }

            $payload = (object)[];
            $payload->products = $mergedArr;
            $payload->subTotal = $subTotal;

            return  $payload;
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }
    try {
        $productId = $req->productId;
        $userId = $req->userId;
        $quantity = $req->quantity;

        $currentCart = getCartItem($userId);

        if (empty($currentCart->products)) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty!'
            ]);
        }

        $item = [];

        foreach ($currentCart->products as $instance) {
            if (strval($instance['product_id'])  === strval($productId)) {
                array_push($item, $instance);
            }
        }


        if (empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'This item is not in your cart!'
            ]);
        }


        $item = $item[0];


        $diff = (int)$quantity - (int)$item['quantity'];

        error_log('$quantity ' . $quantity);
        error_log("item['quantity'] " . $item['quantity']);

        if ($diff > 0) {
            for ($i = 0; $i < $diff; $i++) {
                error_log('product_id ' . $productId);
                Cart::create(['product_id' => $productId, 'customer_id' => $userId]);
            }
        }

        if ($diff < 0) {
            $diff = -$diff;
            error_log($diff);
            for ($i = 0; $i < $diff; $i++) {

                $c = Cart::where(['product_id' => $productId])->first();
                Cart::destroy($c->id);
            }
        }

        $payload = getCartItem($userId);


        return response()->json([
            'message' => 'success',
            'payload' => $payload
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        throw $e;
    }
});


Route::delete('/remove-item', function (Request $req) {
    function getCartItem($customerId)
    {
        try {

            $allCartItems = Cart::where([
                'customer_id' => $customerId
            ])->get()->map(function ($instance) {
                $product = Product::find($instance->product_id);
                $instance->product = $product;
                $instance->quantity = 1;
                return $instance;
            })->toArray();

            $subTotal = array_reduce($allCartItems, function ($acc, $instance) {
                return $acc + $instance['product']['product_price'];
            }, 0);

            $mergedArr = [];

            foreach ($allCartItems as $key => $instance) {
                // $filter = function ($item) use ($instance) {
                //     return $item['product_id'] == $instance['product_id'];
                // };

                // $existingItem = array_filter($mergedArr, $filter);
                $existingItem = [];


                foreach ($mergedArr as $i => $item) {
                    if ($item['product_id'] == $instance['product_id']) {
                        array_push($existingItem, $item);
                    }
                }

                if (!empty($existingItem)) {

                    $index = 0;
                    foreach ($mergedArr as $key => $item) {
                        if ((int) $item['product_id'] === (int) $existingItem[0]['product_id']) {
                            $index = $key;
                            break;
                        }
                    }

                    $mergedArr[$index]['quantity'] = $mergedArr[$index]['quantity'] + 1;
                    // $mergedArr[sizeof($mergedArr) - 1]['quantity'] = $mergedArr[sizeof($mergedArr) - 1]['quantity'] + 1;
                } else {
                    array_push($mergedArr, $instance);
                }
            }

            $payload = (object)[];
            $payload->products = $mergedArr;
            $payload->subTotal = $subTotal;

            return  $payload;
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }
    try {
        $productId = $req->productId;
        $customerId = $req->customerId;

        $cartIds = Cart::where(['product_id' => $productId, 'customer_id' => $customerId])->get()->map(function ($instance) {
            return $instance->id;
        });

        Cart::destroy($cartIds);
        $payload = getCartItem($customerId);
        return response()->json([
            'message' => 'success',
            'payload' => $payload
        ]);
    } catch (Exception $e) {
        error_log($e->getMessage());
        throw $e;
    }
});
 Route::post('/remove-all-item', function(Request $request)
 { 
     try {
         $customerId = $request->customer_id;

        $getCart=Cart::where('customer_id',$customerId)->get();
         Cart::destroy($getCart);


         return response()->json([
             'message' => 'success',
         ]);
     } catch (Exception $e) {
         error_log('Error: ' . $e->getMessage());
     }
 });

Route::post('/save-customorder', function (Request $request) {

    try {
        $files=$request->file('image');
        $filePath = public_path('storage/custom-cake');
        $fileName = '';
        foreach($files as $file){
            if ($file->isValid()) {
            $file->getClientOriginalName();
            $fileName = 'customcake-' . time() . "." . $file->getClientOriginalExtension();
            $file->move($filePath, $fileName);
        }
        }

        $custom['shape'] = $request->input('shape');
        $custom['description'] = $request->input('description');
        $custom['customize_text']=  $request->input('customize_text');
        $custom['image']='storage/custom-cake/'. $fileName;
        $custom['flavor_id']=$request->input('flavor_id');
        $custom['size_id']=$request->input('size_id');
        $custom['vendor_id']=$request->input('vendor_id');
        $custom['customer_id']=$request->input('customer_id');
        CustomCake::create($custom);
        return [
            'message' => 'success',
            
        ];
    } catch (Exception $e) {
        error_log($e->getMessage());
        // throw $e;
        return [
            'message'=>$e->getMessage(),
        ];
    }
    return [
        'message' => 'failed',
    ];
});
Route::post('/customer-logout', function (Request $request) {

        Auth::guard('customer')->logout();
            
        $request->session()->forget('_token');

        
});
Route::get('/order-history/{id}', function (Request $request, $customerId) {

    try {

        $customer = Customer::where('id', $customerId)->first();

        $order = Order::where('customer_id',$customer->id)->get();
        return response()->json([
            'message' => 'success',
            'order' => $order,
        ]);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
    }
    
});
