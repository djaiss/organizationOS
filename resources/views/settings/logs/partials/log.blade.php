<?php
/*
 * @var object $log
 */
?>

<div class="flex items-center justify-between border-b border-gray-200 p-3 text-sm first:rounded-t-lg last:rounded-b-lg last:border-b-0 hover:bg-blue-50">
  <div class="flex items-center gap-3">
    <x-phosphor-pulse class="size-3 min-w-3 text-zinc-600 dark:text-zinc-400" />
    <div class="flex flex-col gap-y-2">
      <p class="flex items-center gap-2">
        <span class="">{{ $log->username }}</span>
        |
        <span class="font-mono ">{{ $log->action }}</span>
      </p>
      <p class="">{{ $log->description }}</p>
    </div>
  </div>

  <x-tooltip text="{{ $log->created_at }}">
    <p class="font-mono text-xs">{{ $log->created_at_diff_for_humans }}</p>
  </x-tooltip>
</div>
