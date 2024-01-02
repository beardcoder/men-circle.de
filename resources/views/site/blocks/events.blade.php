@php
  $events = \App\Models\Event::where('startDate', '>', now())
      ->where('published', '=', 1)
      ->get();
@endphp
@if ($events)

  <x-partials.content.wrapper
    :background="$block->input('background')"
    :anchor="$block->input('anchor')"
  >
    <div class="mx-auto max-w-screen-xl px-6 py-8 sm:py-16">
      <x-partials.content.title data-fade>
        {!! $block->input('title') !!}
      </x-partials.content.title>
      <div
        class="format lg:format-lg dark:format-invert max-w-none"
        data-fade="bottom"
      >
        {!! $block->input('text') !!}
      </div>
      <div class="flex flex-wrap my-8">
        @foreach ($events as $event)
          @php
            $image = TwillImage::make($event, 'event');
            $image->preset([
                'crop' => 'desktop',
                'sizes' => '(max-width: 1023px) 100vw, (min-width: 1023px)',
                'sources' => [
                    [
                        'crop' => 'desktop',
                        'width' => 420,
                        'media_query' => '(max-width: 420px)',
                    ],
                ],
            ]);
          @endphp

          <a
            href="{{ route('event.show', $event->id) }}"
            class="flex md:w-1/2 items-center bg-white border border-stone-200 shadow flex-row hover:bg-stone-100 dark:border-stone-700 dark:bg-stone-800 dark:hover:bg-stone-700"
            data-fade="bottom"
          >
            {!! $image->render([
                'class' => 'object-cover h-full w-1/3 object-center',
            ]) !!}
            <div class="flex flex-col justify-between p-4 leading-normal">
              <h5 class="text-2xl font-bold tracking-tight text-stone-900 dark:text-white">
                {!! $event->title !!}
              </h5>
              <time
                class="text-base mb-2"
                datetime="{{ DateHelper::getLocalDate($event->startDate)->formatLocalized('%d.%m.%Y %H:%M') }}"
              >
                {{ DateHelper::getLocalDate($event->startDate)->formatLocalized('%d.%m.%Y %H:%M') }}
              </time>

              <ul class="max-w-md list-inside space-y-1 text-gray-500 dark:text-gray-400 text-sm">
                <li class="flex items-center">
                  <svg
                    class="me-2 h-3.5 w-3.5 flex-shrink-0 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 14 20"
                  >
                    <path
                      d="M7 0a7 7 0 0 0-1 13.92V19a1 1 0 1 0 2 0v-5.08A7 7 0 0 0 7 0Zm0 5.5A1.5 1.5 0 0 0 5.5 7a1 1 0 0 1-2 0A3.5 3.5 0 0 1 7 3.5a1 1 0 0 1 0 2Z"
                    />
                  </svg>
                  {!! $event->place !!} - {!! $event->addressLocality !!}
                </li>
                <li class="flex items-center">
                  <svg
                    class="me-2 h-3.5 w-3.5 flex-shrink-0 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 14 18"
                  >
                    <path
                      d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"
                    />
                  </svg>
                  Markus Sommer
                </li>
                <li class="flex items-center">
                  <svg
                    class="me-2 h-3.5 w-3.5 flex-shrink-0 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 18"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M1 7h9.231M1 11h9.231M13 2.086A5.95 5.95 0 0 0 9.615 1C5.877 1 2.846 4.582 2.846 9s3.031 8 6.769 8A5.94 5.94 0 0 0 13 15.916"
                    />
                  </svg>
                  {{ Cknow\Money\Money::EUR($event->price) }}
                </li>
              </ul>
            </div>
          </a>
        @endforeach
      </div>
      <div class="text-center mx-auto">
        <p
          class="text-xl"
          data-fade="bottom"
        >
          Kein Event für dich dabei? Melde dich für den Newsletter an
        </p>
        <x-button
          class="mt-4"
          data-fade="bottom"
          type="link"
          href="/#contact"
          size="lg"
        >
          Jetzt Anmelden
        </x-button>
      </div>
    </div>

  </x-partials.content.wrapper>
@endif
