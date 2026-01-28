<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class ShopEnabled
{

    public function handle($request, Closure $next)
    {
        if (!Setting::shopEnabled()) {
            abort(404); // o redirect
        }

        return $next($request);
    }
}
