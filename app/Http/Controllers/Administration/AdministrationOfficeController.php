<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Services\UpdateAccountInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdministrationOfficeController extends Controller
{
    public function index(): View
    {
        return view('administration.offices.index', [
            'user' => [
                'permission' => Auth::user()->permission,
            ],
        ]);
    }
}
