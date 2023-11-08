<x-partials.content.wrapper
  :background="$block->input('background')"
  :anchor="$block->input('anchor')"
>
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:py-24 lg:px-6">
    <div class="mb-8 lg:mb-8">
      <x-partials.content.title data-apper>
        {!! $block->input('title') !!}
      </x-partials.content.title>
      @if ($block->input('text'))
        <p class="text-stone-500 dark:text-stone-400 sm:text-xl">{!! $block->input('text') !!}</p>
      @endif
    </div>
    @foreach ($block->children as $child)
      @php
        $image = TwillImage::make($child, 'tool_image');
      @endphp
      <div class="mx-auto max-w-screen-xl items-center gap-8 px-4 py-8 sm:py-16 md:flex lg:px-6 xl:gap-16">
        <div
          class="{{ $loop->odd ? 'order-1' : 'order-2' }} md:w-1/3"
          data-apper="{{ $loop->odd ? 'left' : 'right' }}"
        >
          {!! $image->render([
              'class' => 'w-full',
          ]) !!}
        </div>
        <div
          class="{{ $loop->odd ? 'order-2' : 'order-1' }} mt-4 md:mt-0 md:w-2/3"
          data-apper="{{ $loop->odd ? 'right' : 'left' }}"
        >
          <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-stone-900 dark:text-white">
            {!! $child->input('title') !!}
          </h2>
          <div class="format md:format-lg mb-6 font-light text-stone-500 dark:text-stone-400">
            {!! $child->input('text') !!}
          </div>
        </div>
      </div>
    @endforeach
</x-partials.content.wrapper>
