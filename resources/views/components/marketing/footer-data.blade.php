<?php
/*
 * Data come from the MarketingFooterData component
 */
?>

<div>
  @if ($pageviews)
    <p class="text-xs text-gray-600">This page has been viewed {{ $pageviews }} times since its creation.</p>
  @endif
</div>
