<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class AppLayout extends Component
{
    public function __construct(
        public string $title = '',
    ) {}

    public function render(): View
    {
        return view('layouts.app');
    }
}
