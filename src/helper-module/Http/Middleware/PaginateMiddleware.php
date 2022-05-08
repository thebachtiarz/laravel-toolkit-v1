<?php

namespace TheBachtiarz\Toolkit\Helper\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TheBachtiarz\Toolkit\Helper\Cache\PaginateCache;

class PaginateMiddleware
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
        if ($request->has('page') || $request->has('perpage'))
            PaginateCache::activatePaginate()->setPaginatePerPage($request->get('perpage'))->setPaginatePage($request->get('page'));
        else
            PaginateCache::reset();

        return $next($request);
    }
}
