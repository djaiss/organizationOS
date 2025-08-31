<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Helpers\MarketingHelper;
use App\Models\MarketingPage;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MarketingFooterData extends Component
{
    public ?string $pageviews = null;

    public function __construct(
        public MarketingPage $marketingPage,
    ) {}

    public function render(): View
    {
        $this->pageviews = number_format($this->marketingPage->pageviews ?? 0);

        return view('components.marketing.footer-data');
    }
}
