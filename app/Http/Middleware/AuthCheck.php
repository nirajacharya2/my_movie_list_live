<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('userInfo') && ($request->path() != 'login' &&  $request->path() != 'signup' && $request->path() != 'sendresetmail' && $request->path() != 'forgotpasswordmail' && !$request->is('forgotpassword/*/*') && $request->path() != 'passwordresetconformation')) {
            return redirect('login')->with('fail', 'You cant acess that page');
        }
        // if (session()->has('userInfo') && ($request->path() == 'sendresetmail' ||  $request->path() == 'forgotpasswordmail' ||  $request->path() == 'forgotpassword' ||  $request->path() == 'passwordresetconformation')) {
        //     return back();
        // }
        if (session()->has('userInfo') && ($request->path() == 'login' || $request->path() == 'signup' || $request->path() == 'sendresetmail' || $request->path() == 'forgotpasswordmail' || $request->is('forgotpassword/*/*') || $request->path() == 'passwordresetconformation')) {
            return back();
        }
        return $next($request)->header('cache-control', 'no-cache,no-store,max-age-0,must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}