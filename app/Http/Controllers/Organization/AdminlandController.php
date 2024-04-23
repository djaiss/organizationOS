<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\ContextViewModel;
use App\Http\ViewModels\MenuViewModel;
use App\Services\CreateOrganization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminlandController extends Controller
{
    public function index(Request $request): View
    {
        return view('organization.adminland.index', [
            'organization' => $request->attributes->get('organization'),
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
