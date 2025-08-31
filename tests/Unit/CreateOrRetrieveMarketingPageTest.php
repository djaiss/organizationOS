<?php

declare(strict_types=1);

use App\Actions\CreateOrRetrieveMarketingPage;

covers(CreateOrRetrieveMarketingPage::class);

it('strips fragments from URL', function (): void {
    $url = 'http://organizationos.test/docs/concepts/hierarchical-structure#key-principles';

    $marketingPage = new CreateOrRetrieveMarketingPage($url)->execute();

    expect($marketingPage->url)->toBe('http://organizationos.test/docs/concepts/hierarchical-structure');
});

it('strips query parameters from URL', function (): void {
    $url = 'http://organizationos.test/docs/concepts/hierarchical-structure?param1=value1&param2=value2';

    $marketingPage = new CreateOrRetrieveMarketingPage($url)->execute();

    expect($marketingPage->url)->toBe('http://organizationos.test/docs/concepts/hierarchical-structure');
});

it('strips both fragments and query parameters from URL', function (): void {
    $url = 'http://organizationos.test/docs/concepts/hierarchical-structure?param1=value1#key-principles';

    $marketingPage = new CreateOrRetrieveMarketingPage($url)->execute();

    expect($marketingPage->url)->toBe('http://organizationos.test/docs/concepts/hierarchical-structure');
});

it('handles URLs with ports correctly', function (): void {
    $url = 'http://organizationos.test:8080/docs/concepts/hierarchical-structure?param1=value1#key-principles';

    $marketingPage = new CreateOrRetrieveMarketingPage($url)->execute();

    expect($marketingPage->url)->toBe('http://organizationos.test:8080/docs/concepts/hierarchical-structure');
});

it('handles URLs without paths correctly', function (): void {
    $url = 'http://organizationos.test?param1=value1#key-principles';

    $marketingPage = new CreateOrRetrieveMarketingPage($url)->execute();

    expect($marketingPage->url)->toBe('http://organizationos.test');
});

it('handles URLs without query parameters or fragments', function (): void {
    $url = 'http://organizationos.test/docs/concepts/hierarchical-structure';

    $marketingPage = new CreateOrRetrieveMarketingPage($url)->execute();

    expect($marketingPage->url)->toBe('http://organizationos.test/docs/concepts/hierarchical-structure');
});

it('increments pageviews when creating or retrieving marketing page', function (): void {
    $url = 'http://organizationos.test/docs/concepts/hierarchical-structure';

    $marketingPage = new CreateOrRetrieveMarketingPage($url)->execute();

    expect($marketingPage->pageviews)->toBe(1);

    // Running it again should increment the pageviews
    $url2 = 'http://organizationos.test/docs/concepts/hierarchical-structure';
    $action2 = new CreateOrRetrieveMarketingPage($url2);
    $marketingPage2 = $action2->execute();

    expect($marketingPage2->pageviews)->toBe(2);
    expect($marketingPage2->id)->toBe($marketingPage->id);
});

it('throws exception for invalid URLs', function (): void {
    $url = 'not-a-valid-url';
    $action = new CreateOrRetrieveMarketingPage($url);

    $action->execute();
})->throws(InvalidArgumentException::class, 'Invalid URL provided');
