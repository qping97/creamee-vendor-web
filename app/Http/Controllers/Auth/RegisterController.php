<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    #protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        // $this->middleware('guest:admin');
        // $this->middleware('guest:vendor');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:customer'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'vendor_name' => ['required', 'string', 'max:255'],
    //         'fullname' => ['required', 'string', 'max:255'],
    //         'username' => ['required', 'string', 'max:255'],
    //         'contact_no' => ['required', 'string', 'max:255'],
    //         'vendor_address' => ['required', 'string', 'max:255'],
    //         'registration_no' => ['required', 'string', 'max:255'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
   

    protected function createVendor(Request $request)
    {
        try{
        if($request->file('image')){
            $file = $request->file('image');
            $filePath = public_path('storage/vendor');
            $fileName = '';
            if($file->isValid()){

                $fileName = 'vendor-'.time().".".$file->getClientOriginalExtension();
                $file->move($filePath,$fileName);
  
             }    
        }
       
        if($request->file('profile_img')){
            $filepro = $request->file('profile_img');
            $fileproPath = public_path('storage/profile_pic/vendor');
            $fileNameimg = '';

            if($filepro->isValid()){
                $fileNameimg = 'profile-'.time().".".$filepro->getClientOriginalExtension();
                $filepro->move($fileproPath,$fileNameimg);
             }      
            
        }
      
            $vendor= new Vendor;
            $vendor->vendor_name = $request->input('vendor_name');
            $vendor->fullname = $request->input('fullname');
            $vendor->username= $request->input('username');
            $vendor->contact_no = $request->input('contact_no');
            $vendor->vendor_address = $request->input('vendor_address'); 
            $vendor->registration_no = $request->input('registration_no'); 
            $vendor->email = $request->input('email');
            $vendor->password = Hash::make($request['password']);
            $vendor->latitude = 0;
            $vendor->longitude =  0;
            $vendor->profile_img ='storage/profile_pic/vendor/'. $fileNameimg; 
            $vendor->image = 'storage/vendor/'. $fileName;
            $vendor->save();

        return redirect()->intended('login/vendor');
    }catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        throw $e;
    }
}

    public function showAdminRegisterForm()
    {
        return view('auth.registeradmin', ['url' => 'admin']);
    }

    public function showVendorRegisterForm()
    {
        return view('auth.registervendor', ['url' => 'vendor']);
    }


}
