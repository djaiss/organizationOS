<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\DashboardViewHelper;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'data' => DashboardViewHelper::index(),
        ]);
    }
}
