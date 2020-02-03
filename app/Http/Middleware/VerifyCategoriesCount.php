<?php

namespace App\Http\Middleware;

use App\Model\Category;
use Closure;

class VerifyCategoriesCount
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
        if (Category::all()->count() === 0) {
            alert()->info('Você precisa criar uma CATEGORIA antes de criar o POST!!', 'Atenção');
            return redirect(route('category.create'));
        }
        return $next($request);
    }
}
