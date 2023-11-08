@php
  $image = TwillImage::make($block, 'cover');
  $image->preset([
      'crop' => 'flexible',
      'sizes' => '(max-width: 1023px) 100vw, (min-width: 1023px)',
      'sources' => [
          [
              'crop' => 'mobile',
              'width' => 420,
              'height' => 420,
              'media_query' => '(max-width: 420px)',
          ],
          [
              'crop' => 'flexible',
              'width' => 1280,
              'media_query' => '(min-width: 420px) and (max-width: 1023px)',
          ],
      ],
  ]);
@endphp

<x-partials.content.wrapper
  class="md:flex"
  :background="$block->input('background')"
  :anchor="$block->input('anchor')"
>
  <div class="flex w-full flex-1 md:w-1/2">
    <div class="mx-auto my-auto max-w-2xl px-8 py-20">
      <h2
        class="mb-4 text-4xl font-extrabold tracking-tight text-stone-900 dark:text-white"
        data-apper
      >
        {!! $block->input('title') !!}
        <span class="text-primary block">{!! $block->input('name') !!}</span>
      </h2>
      <div
        class="format lg:format-lg dark:format-invert max-w-none text-stone-700 dark:text-stone-400"
        data-apper
      >
        {!! $block->input('text') !!}
      </div>
      <x-button
        class="mt-4"
        data-apper
        type="link"
        href="/#contact"
        size="lg"
      >Jetzt dabei sein</x-button>
    </div>
  </div>
  <div class="w-full md:w-1/2">
    {!! $image->render([
        'class' => 'w-full h-full object-cover',
    ]) !!}
  </div>
</x-partials.content.wrapper>
