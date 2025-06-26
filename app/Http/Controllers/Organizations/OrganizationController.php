<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Organizations\OrganizationIndexViewModel;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function index(): View
    {
        $viewModel = new OrganizationIndexViewModel(
            user: Auth::user(),
        );

        return view('organizations.index', ['viewModel' => $viewModel]);
    }
}
