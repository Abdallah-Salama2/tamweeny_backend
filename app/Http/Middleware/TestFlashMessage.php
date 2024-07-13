<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestFlashMessage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        session()->flash('success', 'This is a test flash message from middleware.');
        return $next($request);
    }
}

