<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (\Str::startsWith($request->route()->getName(), 'seller.')){
                return route('seller.login');
            }elseif (\Str::startsWith($request->route()->getName(), 'delivery.')){
                return route('delivery.login');
            }
            return route('login');
        }
    }
}
