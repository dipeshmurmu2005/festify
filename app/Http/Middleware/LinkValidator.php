<?php

namespace App\Http\Middleware;

use App\Enums\LinkStatus;
use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LinkValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUrl = $request->fullUrl();
        $link = Link::where('link', $currentUrl)->first();
        if ($link && $currentUrl == $link->link && $link->status != LinkStatus::REVOKED) {
            return $next($request);
        } else {
            abort('404', 'Invalid Or Expired Link');
        }
    }
}
