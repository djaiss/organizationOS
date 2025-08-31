<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\MarketingPage;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * Create or retrieve a marketing page, and increment the pageviews.
 */
final class CreateOrRetrieveMarketingPage
{
    private MarketingPage $marketingPage;

    public function __construct(
        public string $url,
    ) {}

    public function execute(): MarketingPage
    {
        $this->sanitizeUrl();
        $this->stripFragmentAndQueryParameters();
        $this->createOrRetrieve();
        $this->incrementPageviews();

        return $this->marketingPage;
    }

    private function sanitizeUrl(): void
    {
        $this->url = Str::of($this->url)->trim()->toString();
    }

    private function stripFragmentAndQueryParameters(): void
    {
        $parsedUrl = parse_url($this->url);

        if ($parsedUrl === false || !isset($parsedUrl['scheme'], $parsedUrl['host'])) {
            throw new InvalidArgumentException('Invalid URL provided');
        }

        // Reconstruct URL with only scheme, host, and path
        $this->url = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

        if (isset($parsedUrl['port'])) {
            $this->url .= ':' . $parsedUrl['port'];
        }

        if (isset($parsedUrl['path'])) {
            $this->url .= $parsedUrl['path'];
        }
    }

    private function createOrRetrieve(): void
    {
        $this->marketingPage = MarketingPage::where('url', $this->url)->firstOrCreate([
            'url' => $this->url,
        ]);
    }

    private function incrementPageviews(): void
    {
        $this->marketingPage->increment('pageviews');
    }
}
