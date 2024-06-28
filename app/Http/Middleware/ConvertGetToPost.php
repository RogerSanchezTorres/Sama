<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertGetToPost
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('get')) {
            $request->setMethod('POST');
        }

        return $next($request);
    }
}
