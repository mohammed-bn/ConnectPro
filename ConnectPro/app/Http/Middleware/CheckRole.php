<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($role === 'professionnel' && is_null($user->professionnel)) {
            return redirect('/client/dashboard')->with('error', 'Accès non autorisé');
        }

        if ($role ===  'client' &&  is_null($user->client)) {
            return redirect('/professionnel/dashboard')->with('error', 'Accès non autorisé');
        }
        if ($role === 'admin' && !$user->admin) {

            return redirect('/client/dashboard')->with('error', 'Accès réservé aux administrateurs');
        }

        return $next($request);
    }
}

