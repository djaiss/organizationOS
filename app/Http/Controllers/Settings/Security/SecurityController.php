<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;

final class SecurityController extends Controller
{
    public function index(Request $request): View
    {
        $apiKeys = Auth::user()->tokens
            ->map(fn(PersonalAccessToken $token) => (object) [
                'id' => $token->id,
                'name' => $token->name,
                'last_used' => $token->last_used_at ? $token->last_used_at->diffForHumans() : trans('Never'),
                'just_added' => false,
                'token' => $token->token,
            ]);

        return view('settings.security.index', [
            'user' => $request->user(),
            'apiKeys' => $apiKeys,
        ]);
    }
}
