<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    ////2 parameters first request as any route have a request ,
    public function handle(Request $request, Closure $next)
    {
        // logic
        if (!Auth::guard('admin')->check()) {
            return view("welcome");
        }
        return $next($request);
        //next bta3 request ya3ny 3ady order ro7 3la next move
    }
}
