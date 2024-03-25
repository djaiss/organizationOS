<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * This displays the information about the logged user.
 */
class MeController extends Controller
{
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
