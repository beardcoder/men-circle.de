@php
  $image = cache()->rememberForever("{$block->id}.image", function () use ($block) {
      return TwillImage::make($block, 'hero');
  });
  $image->preset([
      'crop' => 'desktop',
      'sizes' => '(max-width: 1023px) 100vw, (min-width: 1023px)',
      'sources' => [
          [
              'crop' => 'mobile',
              'width' => 420,
              'height' => 420,
              'media_query' => '(max-width: 420px)',
          ],
          [
              'crop' => 'desktop',
              'media_query' => '(min-width: 420px) and (max-width: 1023px)',
          ],
      ],
  ]);
@endphp

<section class="relative w-full">
  <div class="relative z-10 flex max-w-[100vw] items-center pb-24 pt-40 xl:aspect-video">
    <div class="mx-auto max-w-5xl px-6">
      <h1 class="font-header text-4xl font-black uppercase text-white sm:text-4xl md:text-8xl md:leading-none">
        {!! $block->input('title') !!}
      </h1>
      <div class="format mb-12 mt-8 max-w-3xl text-2xl text-white">
        {!! $block->input('text') !!}
      </div>
      <x-button
        type="link"
        href="/#contact"
        size="xl"
      >
        Ja ich will dabei sein
      </x-button>
    </div>
  </div>
  <div class="absolute inset-0 w-full after:absolute after:inset-0 after:bg-black after:bg-opacity-40">
    {!! $image->render([
        'lqip' => true,
        'loading' => 'eager',
        'class' => 'w-full h-full object-cover object-center',
    ]) !!}
  </div>
</section>
