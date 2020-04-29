<?php

namespace App\Http\Middleware;

use Closure;

class UserHasStoreMiddleware
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
        // verificando se usuário logado já possui loja
        if (auth()->user()->store()->count()) {
            flash('Usuário já possui loja cadastrada')->warning();
            return redirect()->route('stores.index');
        }
        
        return $next($request);
    }
}
