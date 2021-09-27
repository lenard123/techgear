<?php use App\Components\AlertComponent; ?>
<div
  x-data="alert"
  class="alert-message flex items-center fixed bottom-5 p-5 rounded-lg text-sm text-white <?= $status === AlertComponent::STATUS_SUCCESS ? 'bg-green-700' : 'bg-red-700' ?>" 
  style="width: 300px; right: -300px; transition: right 300ms linear, opacity 300ms linear;"
  :style="{right: right, opacity: opacity}"
>
  <?php if ($status === AlertComponent::STATUS_SUCCESS) : ?>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle w-5 h-5 mx-2">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
  <?php else : ?>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-5 h-5 mx-2">
        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg>
  <?php endif; ?>
  <?= __($message) ?>
</div>