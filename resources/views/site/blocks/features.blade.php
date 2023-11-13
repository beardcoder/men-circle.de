<x-partials.content.wrapper
  :background="$block->input('background')"
  :anchor="$block->input('anchor')"
>
  <div class="mx-auto max-w-screen-xl px-6 py-8 sm:py-24 lg:px-6">
    <div class="mb-8 lg:mb-16">
      <x-partials.content.title data-apper>
        {!! $block->input('title') !!}
      </x-partials.content.title>
      <p class="sm:text-xl">{!! $block->input('description') !!}</p>
    </div>
    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @foreach ($block->children as $child)
        <div
          class="delay-200"
          data-apper
        >
          <h3 class="mb-2 text-xl font-bold dark:text-white">
            {!! $child->input('title') !!}
          </h3>
          <p>
            {!! $child->input('text') !!}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</x-partials.content.wrapper>
