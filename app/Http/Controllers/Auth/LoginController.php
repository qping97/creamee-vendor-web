<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Vendor;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    #protected $redirectTo = RouteServiceProvider::HOME;
    # you have to modify this variable as per condition


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest:admin')->except('logout');
        // $this->middleware('guest:vendor')->except('logout');
    }

     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdminLoginForm()
    {
        return view('auth.loginadmin', ['url' => 'admin']);
    }

    public function showVendorLoginForm()
    {
        return view('auth.loginvendor', ['url' => 'vendor']);
    }

    public function customerLogin(Request $request)
    {
        try {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $customer = Customer::where(['email' => $request->email])->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'user not found'
            ]);
        }

        if (Hash::check($request->password, $customer->password)) {
            return response()->json([
                'customer' => $customer,
                'success' => true,
                'message' => 'success!!!'
            ]);
            
        }
        
        return response()->json([
            'success' => false,
           'message' => 'false'
        ]);

        } catch (Exception $e) {
            error_log('Error: '. $e->getMessage());
            return response()->json([
                'message'=> $e->getMessage()
            ]);
        }
        
    }

    public function adminLogin(Request $request)
    {
        $this->redirectTo  = '/admin/dashboard';
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $this->redirectTo  = '/admin';
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
         
            return redirect()->route('admin.dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function vendorLogin(Request $request)
    {
        $this->redirectTo  = '/vendor/dashboard';
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::guard('vendor')->user()->isblock == 1){
              
               Auth::guard('vendor')->logout();
               $request->session()->forget('_token');
               $message = 'Your acc have been banned';
               return redirect()->route('vendorLogin')
                ->with('status',$message)
                ->withErrors(['email'=>$message]);

           }
            return redirect()->intended('/vendor/dashboard');
        }
        return back()->withInput($request->only('email'));
    }

    public function logoutVendor(Request $request) 
    {
        Auth::guard('vendor')->logout();
            
        $request->session()->forget('_token');

        return redirect()->route('vendorLogin');
    }


    public function logoutAdmin(Request $request) 
    {
        Auth::guard('admin')->logout();
            
        $request->session()->forget('_token');

        return redirect()->route('adminLogin');
    }
}
