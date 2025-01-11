<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTeamApi
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $team = $request->route()->parameter('team');

        if (! Auth::user()->teams()->where('id', $team->id)->exists()) {
            abort(403);
        }

        $request->attributes->add(['team' => $team]);

        return $next($request);
    }
}
