<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings\Security;

use App\Actions\CreateApiKey;
use App\Actions\UpdateUserPassword;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    public function new(): View
    {
        return view('settings.security.partials.api.new');
    }

    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|min:3|max:255',
        ]);

        $apiKey = new CreateApiKey(
            user: Auth::user(),
            label: $validated['label'],
        )->execute();

        return redirect()->route('settings.security.index')
            ->with('apiKey', $apiKey)
            ->with('status', trans('API key created'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)->uncompromised(),
            ],
        ]);

        new UpdateUserPassword(
            user: Auth::user(),
            currentPassword: $validated['current_password'],
            newPassword: $validated['new_password'],
        )->execute();

        return redirect()->route('settings.security.index')
            ->with('status', __('Changes saved'));
    }
}
