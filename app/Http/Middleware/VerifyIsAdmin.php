<?php

namespace App\Http\Middleware;
use App\Model\User;
use Closure;

class VerifyIsAdmin
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
        if (!auth()->user()->isAdmin()) {
            alert()->info('Você não tem permissão para realizar essa ação', 'Atenção');
            return redirect(route('home'));
        }
        return $next($request);
    }
}
