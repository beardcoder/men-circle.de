<section class="bg-white dark:bg-stone-800">
  <div
    class="mx-auto max-w-screen-xl px-4 py-8 sm:py-24 lg:px-6"
    data-apper
  >
    <div class="mb-8 lg:mb-16">
      <h2 class="mb-4 text-center text-4xl font-extrabold tracking-tight text-stone-900 dark:text-white">
        {!! $block->input('title') !!}
      </h2>
      <p class="text-stone-500 dark:text-stone-400 sm:text-xl">{!! $block->input('description') !!}</p>
    </div>
    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @foreach ($block->children as $child)
        <div>
          <h3 class="mb-2 text-xl font-bold dark:text-white">
            {!! $child->input('title') !!}
          </h3>
          <p class="text-stone-500 dark:text-stone-400">
            {!! $child->input('text') !!}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>
