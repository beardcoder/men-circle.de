@php
  $backgroundColor = $background ? 'bg-stone-100 dark:bg-stone-900' : 'bg-white dark:bg-stone-800';
@endphp
<section
  {{ $attributes->merge(['class' => 'text-stone-800 dark:text-stone-100 w-full overflow-x-hidden' . $backgroundColor]) }}
  {{ $anchor ? 'id=' . $anchor . '' : '' }}
>
  {{ $slot }}
</section>
