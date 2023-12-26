@props(['background' => false])

@php
  $backgroundColor = $background ? 'bg-stone-100 dark:bg-stone-900' : 'bg-white dark:bg-stone-800';
@endphp

<section
  {{ $attributes->merge(['class' => 'max-w-[100vw] overflow-hidden text-stone-800 dark:text-stone-100 ' . $backgroundColor]) }}
  {{ $anchor ? 'id=' . $anchor . '' : '' }}
>
  {{ $slot }}
</section>
