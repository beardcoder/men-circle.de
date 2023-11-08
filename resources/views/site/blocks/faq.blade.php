<x-partials.content.wrapper
  :background="$block->input('background')"
  :anchor="$block->input('anchor')"
  itemscope
  itemtype="https://schema.org/FAQPage"
>
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:py-16 lg:px-6">
    <x-partials.content.title data-apper>
      {!! $block->input('title') !!}
    </x-partials.content.title>
    <div class="grid border-t border-gray-200 pt-8 text-left dark:border-gray-700 md:grid-cols-2 md:gap-16">
      @foreach ($block->children as $child)
        <div
          data-apper="{{ $loop->odd ? 'left' : 'right' }}"
          itemscope
          itemprop="mainEntity"
          itemtype="https://schema.org/Question"
        >
          <div class="mb-10">
            <h3
              class="mb-4 flex items-center text-lg font-medium text-gray-900 dark:text-white"
              itemprop="name"
            >
              <svg
                class="mr-2 h-5 w-5 flex-shrink-0 text-gray-500 dark:text-gray-400"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              {!! $child->input('question') !!}
            </h3>
            <div
              itemscope
              itemprop="acceptedAnswer"
              itemtype="https://schema.org/Answer"
            >
              <div
                class="format lg:format-lg text-gray-500 dark:text-gray-400"
                itemprop="text"
              >
                {!! $child->input('answer') !!}
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
</x-partials.content.wrapper>
