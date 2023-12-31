@extends('site.layouts.event')

@php
  $image = TwillImage::make($item, 'event');
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

  $map = TwillImage::make($item, 'event_map');
  $map->preset([
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

@section('content')
  <main>
    <section class="relative grid min-h-screen overflow-hidden lg:grid-cols-2">
      <div
        class="pointer-events-none absolute left-1/2 top-[850px] z-10 h-32 w-32 -translate-x-1/2 -translate-y-1/2 lg:top-1/2"
      >
        <div
          class="bg-secondary rounded-full"
          data-fade="bottom"
        >
          <img
            class="h-full w-auto"
            src="{{ URL::asset('/assets/web/images/logo-white.svg') }}"
            alt="logo"
            width="500"
            height="500"
          />
        </div>
      </div>
      <div class="mx-auto my-auto flex h-[850px] max-w-xl px-8 py-20 lg:h-auto lg:px-20">
        <div class="mx-auto my-auto">
          <h1
            class="mb-4 text-4xl font-bold tracking-tight text-stone-900 dark:text-white"
            data-fade="left"
          >
            Anmeldung zum Männerkreis am <time
              datetime="{{ DateHelper::getLocalDate($item->startDate)->formatLocalized('%d.%m.%Y %H:%M') }}"
            > {{ DateHelper::getLocalDate($item->startDate)->formatLocalized('%d.%m.%Y %H:%M') }}
            </time>
          </h1>
          <livewire:register event="{{ $item->id }}" />
          <div
            class="mt-8 text-sm"
            data-fade="left"
          >

            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Veranstaltungsdaten:</h2>
            <ul class="max-w-md list-inside space-y-1 text-gray-500 dark:text-gray-400">
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
                {!! $item->place !!} - {!! $item->streetAddress !!}, {!! $item->postalCode !!} {!! $item->addressLocality !!}
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
                  fill="currentColor"
                  viewBox="0 0 20 16"
                >
                  <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                  <path
                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"
                  />
                </svg>
                <a
                  class="text-primary underline"
                  href="mailto:markus@letsbenow.de"
                >
                  markus@letsbenow.de
                </a>
              </li>
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
                {{ Cknow\Money\Money::EUR($item->price) }}
              </li>
              <li class="flex items-center">
                <svg
                  class="me-2 h-3.5 w-3.5 flex-shrink-0 text-gray-500 dark:text-gray-400"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 20 20"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 1v3m5-3v3m5-3v3M1 7h18M5 11h10M2 3h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"
                  />
                </svg>
                <a
                  href="{{ route('event.ical', $item->id) }}"
                  download
                >Kalender Download</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="h-[500px] lg:h-auto">
        <div
          class="h-full"
          data-fade="right"
        >
          {!! $image->render([
              'lqip' => true,
              'loading' => 'eager',
              'class' => 'w-full h-full object-cover object-center',
          ]) !!}
        </div>
      </div>
    </section>
    <div>
      {!! $item->renderBlocks() !!}
    </div>

    <section class="aspect-square lg:aspect-auto">
      <div
        class="aspect-square lg:aspect-[16/5]"
        id="map"
      ></div>
      <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""
      ></script>
      <script>
        var map = L.map('map', {
          zoomControl: false,
          scrollWheelZoom: false,
          gestureHandling: true,
        }).setView([{{ $item->latitude }}, {{ $item->longitude }}], 100);
        var marker = L.marker([{{ $item->latitude }}, {{ $item->longitude }}]).addTo(map);
        marker.bindPopup("{!! $item->place !!} - {!! $item->streetAddress !!}, {!! $item->postalCode !!} {!! $item->addressLocality !!}")
          .openPopup();
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.svg', {
          attribution: '©OpenStreetMap, ©CartoDB'
        }).addTo(map);
      </script>
    </section>
  </main>
@stop
