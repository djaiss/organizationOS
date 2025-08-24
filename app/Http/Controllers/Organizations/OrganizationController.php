<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Organizations\OrganizationIndexViewModel;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

final class OrganizationController extends Controller
{
    public function index(): View
    {
        $viewModel = new OrganizationIndexViewModel(
            user: Auth::user(),
        );

        return view('organizations.index', [
            'viewModel' => $viewModel,
        ]);
    }

    public function store(Request $request): void
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class, 'disposable_email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->uncompromised(),
            ],
            'organization_name' => [
                'required',
                'string',
                'max:255',
                'unique:' . Organization::class . ',name',
                'regex:/^[a-zA-Z0-9\s\-_]+$/',
            ],
        ]);
    }
}
