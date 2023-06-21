<?php

namespace App\Http\Middleware;

use App\Models\vender;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class VendorAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check())
        {
            return redirect('/login');
            
        }
        else
        {
            if(Auth::user()->role->role !='vendor')
            {
                Alert::error('No Permission','You are not vendor');
                return redirect('/');
            }
        }
        return $next($request);
    }
}