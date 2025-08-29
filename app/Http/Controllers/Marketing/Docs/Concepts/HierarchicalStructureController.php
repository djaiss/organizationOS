<?php

declare(strict_types=1);

namespace App\Http\Controllers\Marketing\Docs\Concepts;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

final class HierarchicalStructureController extends Controller
{
    public function index(): View
    {
        return view('marketing.docs.concepts.hierarchy-structure');
    }
}
