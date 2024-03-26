<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (is_string($request->route()->parameter('organization'))) {
            $id = (int) $request->route()->parameter('organization');
        } else {
            $id = $request->route()->parameter('organization')->id;
        }

        try {
            $organization = Organization::findOrFail($id);

            $isPartOfOrganization = $organization->users->contains(auth()->user()->id);

            if (! $isPartOfOrganization) {
                abort(401);
            }

            // this makes the organization available in the request
            // like $request->organization, in your controllers
            $request->attributes->add(['organization' => $organization]);

            return $next($request);
        } catch (ModelNotFoundException) {
            abort(401);
        }
    }
}
