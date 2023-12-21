<x-partials.content.wrapper
  :background="$block->input('background')"
  :anchor="$block->input('anchor')"
>
  <div class="mx-auto max-w-screen-md px-6 py-8 lg:py-16">
    <x-partials.content.title data-fade="bottom">
      {!! $block->input('title') !!}
    </x-partials.content.title>
    @if ($block->input('text'))
      <p
        class="mb-8 text-center sm:text-xl lg:mb-16"
        data-fade="bottom"
      >
        {!! $block->input('text') !!}
      </p>
    @endif
    <livewire:newsletter />
  </div>
</x-partials.content.wrapper>
