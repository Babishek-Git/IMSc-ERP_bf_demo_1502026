<?php

namespace App\Http\Middleware;

use Closure;

class CheckReferrer
{
    public function handle($request, Closure $next)
    {
        $referrer = $request->headers->get('referer');

        if (!$referrer || strpos($referrer, config('app.url')) !== 0) {
            // The request does not come from within the application
            //return redirect()->to('/home'); // Change 'home' to the desired redirect route
        }

        return $next($request);
    }
}
