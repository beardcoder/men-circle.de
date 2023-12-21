@extends('site.layouts.appointment')

@php
  $image = TwillImage::make($item, 'appointment');
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

  $map = TwillImage::make($item, 'appointment_map');
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
    <div class="relative grid min-h-screen lg:grid-cols-2">
      <div class="pointer-events-none absolute left-1/2 top-1/2 z-10 h-32 w-32 -translate-x-1/2 -translate-y-1/2">
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
      <div class="mx-auto my-auto flex h-[600px] max-w-xl px-8 py-20 lg:h-auto lg:px-20">

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
          <livewire:register appointment="{{ $item->id }}" />
        </div>
      </div>

      <div class="h-[600px] lg:h-auto">
        <div data-fade="right">
          {!! $image->render([
              'lqip' => true,
              'loading' => 'eager',
              'class' => 'w-full h-full object-cover object-center',
          ]) !!}
        </div>
      </div>
    </div>
    @if ($item->hasImage('appointment_map', 'desktop'))
      <div class="aspect-square lg:aspect-auto">
        {!! $map->render([
            'lqip' => true,
            'class' => 'w-full h-full object-cover object-center',
        ]) !!}
      </div>
    @endif
  </main>
@stop