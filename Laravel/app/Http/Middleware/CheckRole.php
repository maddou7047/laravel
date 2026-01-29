<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }


        if (!auth()->user->Role !== $roles) {
            abort(403, 'Je hebt geet toegang tot deze pagina.');
        }


        if (!in_array($request->user()->Role, $roles)) {
            abort(403, 'Geen Toegang');
        }





        return $next($request);
    }
}
