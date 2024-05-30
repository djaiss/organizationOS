<?php

namespace App\Http\Controllers\Organization\Adminland;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Organization\Adminland\AdminlandPermissionViewModel;
use App\Http\ViewModels\Organization\AdminlandViewModel;
use App\Services\CreateOrganization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminlandPermissionController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->attributes->get('organization');

        return view('organization.adminland.permission.index', [
            'data' => AdminlandPermissionViewModel::index($organization),
        ]);
    }

    public function new(): View
    {
        return view('organization.new');
    }

    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'organization_name' => ['required', 'string', 'max:255'],
        ]);

        $organization = (new CreateOrganization(
            name: $validated['organization_name'],
        ))->execute();

        $request->session()->flash('status', __('The organization has been created'));

        return redirect()->route('organization.show', $organization);
    }
}
