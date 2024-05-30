<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Services\CreateOrganization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationController extends Controller
{
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

    public function show(Request $request): View
    {
        return view('organization.show', [
            'organization' => $request->attributes->get('organization'),
        ]);
    }
}
