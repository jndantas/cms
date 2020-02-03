<?php

namespace App\Http\Middleware;

use App\Model\Tag;
use Closure;

class VerifyTagsCount
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
        if (Tag::all()->count() === 0) {
            alert()->info('Você precisa criar pelo menos uma TAG antes de criar o POST.', 'Atenção');
            return redirect(route('tag.create'));
        }
        return $next($request);
    }
}
