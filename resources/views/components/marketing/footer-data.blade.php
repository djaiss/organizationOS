<?php
/*
 * Data come from the MarketingFooterData component
 */
?>

<div>
  @if ($pageviews)
    <p class="text-xs text-gray-600">
      {{ __('This page has been viewed :views times since its creation.', ['views' => $pageviews]) }}
    </p>
  @endif
</div>
