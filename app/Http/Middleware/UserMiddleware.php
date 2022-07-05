<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        // Membatasi Route Acce
        // Khusus untuk "user", admin tidak terpengaruh
        // Yang menjadi faktor pengaruh atau tidak di guard, guard user itu masuk kedalam "web", tapi guard admin yaitu "admin"
        if(Auth::guard('web')->check())
        {
            $routeDestination = $request->route()->getName();
            $permissionAvailable = Auth::guard('web')->user()->user_role->route_limiter->pluck('route');
            if(in_array($routeDestination, ['home.index', 'admin.logout'])){
                return $next($request);
            }
            if(!empty($permissionAvailable->toArray())){
                if(!$permissionAvailable->contains($routeDestination))
                {
                    return redirect()->route('home.index')->with('error', 'You have no access to the destination');
                }
            }
        }
        return $next($request);
    }
}
