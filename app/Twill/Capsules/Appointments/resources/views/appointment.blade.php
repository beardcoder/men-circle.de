@extends('Appointments.resources.views.layouts.page')

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
      <div
        class="pointer-events-none absolute left-1/2 top-1/2 z-10 aspect-square h-32 w-32 -translate-x-1/2 -translate-y-1/2 lg:aspect-auto"
      >
        <img
          class="h-full w-auto dark:hidden"
          src="{{ URL::asset('/assets/web/images/logo-black.svg') }}"
          alt="logo"
          width="500"
          height="500"
        />
        <img
          class="hidden h-full w-auto dark:block"
          src="{{ URL::asset('/assets/web/images/logo-white.svg') }}"
          alt="logo"
          width="500"
          height="500"
        />
      </div>
      <div class="mx-auto my-auto flex h-[600px] max-w-xl px-8 py-20 lg:h-auto lg:px-20">

        <div class="mx-auto my-auto">
          <h1
            class="mb-4 text-4xl font-bold tracking-tight text-stone-900 dark:text-white"
            data-fade="bottom"
          >
            Anmeldung zum Männerkreis am <time
              datetime="{{ DateHelper::getLocalDate($item->date)->formatLocalized('%d.%m.%Y %H:%M') }}"
            > {{ DateHelper::getLocalDate($item->date)->formatLocalized('%d.%m.%Y %H:%M') }}
            </time>
          </h1>
          <form
            class="space-y-8"
            action="{{ route('appointment.registration', $item->id) }}"
            method="POST"
          >
            @csrf
            @honeypot
            <div data-fade="bottom">
              <label
                class="mb-2 block text-sm font-medium text-stone-900 dark:text-stone-300"
                for="name"
              >
                Dein Name
              </label>
              <input
                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light block w-full border border-stone-300 bg-stone-50 p-2.5 text-sm text-stone-900 shadow-sm dark:border-stone-600 dark:bg-stone-700 dark:text-white dark:placeholder-stone-400"
                id="name"
                name="name"
                type="text"
                placeholder="Christian Baumer"
                required
              >
            </div>
            <div data-fade="bottom">
              <label
                class="mb-2 block text-sm font-medium text-stone-900 dark:text-stone-300"
                for="email"
              >
                Deine Email
              </label>
              <input
                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light block w-full border border-stone-300 bg-stone-50 p-2.5 text-sm text-stone-900 shadow-sm dark:border-stone-600 dark:bg-stone-700 dark:text-white dark:placeholder-stone-400"
                id="email"
                name="email"
                type="email"
                placeholder="christian.baumer@mens-circle.de"
                required
              >
            </div>

            <x-button
              class="block w-full"
              data-fade="bottom"
              type="submit"
              size="md"
            >Jetzt Anmelden</x-button>
          </form>
        </div>
      </div>

      <div class="h-[600px] lg:h-auto">
        {!! $image->render([
            'lqip' => true,
            'loading' => 'eager',
            'class' => 'w-full h-full object-cover object-center',
        ]) !!}
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
