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
    <section class="relative grid min-h-screen lg:grid-cols-2">
      <div
        class="pointer-events-none absolute left-1/2 top-[650px] z-10 h-32 w-32 -translate-x-1/2 -translate-y-1/2 lg:top-1/2"
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
      <div class="mx-auto my-auto flex h-[650px] max-w-xl px-8 py-20 lg:h-auto lg:px-20">
        <div class="mx-auto my-auto">
          <h1
            class="mb-4 text-4xl font-bold tracking-tight text-stone-900 dark:text-white"
            data-fade="left"
          >
            Anmeldung zum Männerkreis am <time
              datetime="{{ DateHelper::getLocalDate($item->date)->formatLocalized('%d.%m.%Y %H:%M') }}"
            > {{ DateHelper::getLocalDate($item->date)->formatLocalized('%d.%m.%Y %H:%M') }}
            </time>
          </h1>
          <livewire:register event="{{ $item->id }}" />
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
        }).setView([48.882795, 12.570681], 100);
        var marker = L.marker([48.882795, 12.570681]).addTo(map);
        marker.bindPopup("<b>Hier&Jetzt Yogastudio - Straubing</b><br>Fraunhoferstraße 13, 94315 Straubing").openPopup();
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.svg', {
          attribution: '©OpenStreetMap, ©CartoDB'
        }).addTo(map);
      </script>
    </section>
  </main>
@stop
