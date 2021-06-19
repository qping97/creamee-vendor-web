<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard=null)
    {
        // this have not auth data , can't make check here
        $guard="vendor";
       if(Auth::check() && Auth::guard($guard)->isblock)
        {
            $banned= Auth::guard($guard)->isblock =="1";
            Auth::logout();

            if($banned==1){
                $message='Your acc have been banned';
            }
            return redirect()->route('login/vendor')
            ->with('status',$message)
            ->withErrors(['email'=>'Your acc have been banned']);
        }
        return $next($request);
    }
}