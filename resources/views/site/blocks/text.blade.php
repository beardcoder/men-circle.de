<section class="bg-white dark:bg-stone-900">
  <div class="mx-auto max-w-screen-xl items-center gap-16 px-4 py-8 lg:grid lg:grid-cols-2 lg:px-6 lg:py-16">
    <div class="font-light text-stone-500 dark:text-stone-400 sm:text-lg">
      <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-stone-900 dark:text-white">
        {!! $block->input('title') !!}
      </h2>
      <div>
        {!! $block->input('text') !!}
      </div>
    </div>
    @if ($item->hasImage('text_image'))
      <div class="mt-8">
        <img
          class="w-full"
          src="{{ $item->image('text_image') }}"
          alt="{{ $item->imageAltText('text_image') }}"
        />
      </div>
    @endif
  </div>
</section>
