@php
  $image = TwillImage::make($block, 'cover');
  $image->preset([
      'crop' => 'default',
      'sizes' => '(max-width: 1023px) 100vw, (min-width: 1023px)',
      'sources' => [
          [
              'crop' => 'mobile',
              'width' => 420,
              'height' => 420,
              'media_query' => '(max-width: 420px)',
          ],
          [
              'crop' => 'default',
              'media_query' => '(min-width: 420px) and (max-width: 1023px)',
          ],
      ],
  ]);
@endphp

<section class="dark:textwhite bg-stone-100 text-stone-900 dark:bg-stone-900 dark:text-white md:flex">
  <div class="w-full md:w-1/2">
    {!! $image->render([
        'loading' => 'eager',
        'class' => 'w-full h-full object-cover',
    ]) !!}
  </div>
  <div class="w-full flex-1 md:w-1/2">
    <div class="mx-auto max-w-2xl px-8 py-20 text-center">
      <h2 class="font-header mb-6 text-xl font-bold uppercase sm:text-2xl md:text-4xl">
        {!! $block->input('title') !!}
        <span class="text-primary-500 block">{!! $block->input('name') !!}</span>
      </h2>
      <div class="format lg:format-lg dark:format-invert max-w-none text-stone-700 dark:text-stone-400">
        {!! $block->input('text') !!}
      </div>
      <x-button
        class="mt-4"
        type="link"
        href="/#contact"
        size="lg"
      >Jetzt dabei sein</x-button>
    </div>
  </div>
</section>
