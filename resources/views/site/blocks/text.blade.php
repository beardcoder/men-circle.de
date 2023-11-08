@php
  $hasImage = $block->hasImage('text_image');
@endphp

<x-partials.content.wrapper
  :background="$block->input('background')"
  :anchor="$block->input('anchor')"
>
  <div
    class="{{ $hasImage ? 'lg:grid lg:grid-cols-2' : '' }} mx-auto max-w-screen-xl items-center gap-16 px-4 py-8 lg:px-6 lg:py-16"
  >
    <div class="{{ $hasImage ? '' : 'mx-auto' }} max-w-4xl font-light text-stone-500 dark:text-stone-400 sm:text-lg">
      <x-partials.content.title data-apper>
        {!! $block->input('title') !!}
      </x-partials.content.title>
      <div class="format lg:format-lg dark:format-invert max-w-none">
        {!! $block->input('text') !!}
      </div>
    </div>
    @if ($hasImage)
      <div class="mt-8">
        <img
          class="w-full"
          src="{{ $block->image('text_image') }}"
          alt="{{ $block->imageAltText('text_image') }}"
        />
      </div>
    @endif
  </div>
</x-partials.content.wrapper>
