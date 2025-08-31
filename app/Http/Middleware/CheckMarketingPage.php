<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Actions\CreateOrRetrieveMarketingPage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class CheckMarketingPage
{
    /**
     * Track and increment page views for marketing pages.
     * Attaches the marketing page record to the request attributes.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $url = $request->fullUrl();

        // make sure the URL is not longer than 255 characters
        // 414 HTTP Request-URI Too Long
        if (mb_strlen($url) > 255) {
            abort(414);
        }

        $page = new CreateOrRetrieveMarketingPage($url)->execute();

        $request->attributes->add(['marketingPage' => $page]);

        return $next($request);
    }
}
