<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * This displays the information about the logged user.
 */
class MeController extends Controller
{
    /**
     * /api/me GET
     *
     * This endpoint gets the information about the logged user.
     *
     * @response {
     *  "id": 4,
     *  "name": "Jessica Jones",
     *  "email": "jessica.jones@gmail.com"
     * }
     */
    public function show(Request $request): array
    {
        $response = [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ];

        return $response;
    }
}
