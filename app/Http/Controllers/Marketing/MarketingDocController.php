<?php

declare(strict_types=1);

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

final class MarketingDocController extends Controller
{
    public function index(): View
    {
        return view('marketing.docs.index');
    }
}
