<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OualidDemoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment('demo') && in_array($request->method(), ['POST', 'PUT', 'DELETE','PATCH'])) {
            return redirect()->back()->with(['demo' => 'Un Administrateur A bloquer les actions de modification et l\'ajoute, contacter ce admin: oualidhamri@icloud.com'], 403);
        }

        return $next($request);
    }
}
