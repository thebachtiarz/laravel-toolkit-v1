<?php

namespace TheBachtiarz\Toolkit\Helper\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TheBachtiarz\Toolkit\Helper\Cache\PaginatorCache;

class PageSimpleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        PaginatorCache::enable();

        if ($request->has('currentPage') || $request->has('perPage')) {
            PaginatorCache::setCurrentPage($request->get('currentPage'))->setPerPage($request->get('perPage'));
        } else {
            PaginatorCache::reset();
        }

        return $next($request);
    }
}
