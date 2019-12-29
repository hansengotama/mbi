<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdminOrPicKecamatan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role != "admin" && Auth::user()->role != "pic_kecamatan" && Auth::user()->role != "super_admin") {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
