@props(['menu' => true])

@php($color = 'text-black dark:text-white')
@php($absolute = '')
@php($logo = '/assets/web/images/logo-black.svg')

@if (Request::path() == 'startseite' || Request::path() == '/')
  @php($color = 'text-white')
  @php($absolute = 'absolute')
  @php($logo = '/assets/web/images/logo-white.svg')
@endif

<header class="{{ $absolute }} top-0 z-20 h-32 w-full md:h-20">
  <div class="mx-auto flex h-20 max-w-screen-xl flex-col items-center px-2 py-2 md:flex-row">
    <a
      class="block h-16 w-16"
      href="/"
    >
      <img
        class="{{ $color }} h-full w-auto dark:hidden"
        src="{{ URL::asset($logo) }}"
        alt="logo"
        width="500"
        height="500"
      />
      <img
        class="{{ $color }} hidden h-full w-auto dark:block"
        src="{{ URL::asset('/assets/web/images/logo-white.svg') }}"
        alt="logo"
        width="500"
        height="500"
      />
      <span class="sr-only">Startseite</span>
    </a>
    @if ($menu)
      <nav class="{{ $color }} mx-auto md:mr-0">
        <x-main-menu />

        {{-- <a href="/impressum">Impressum</a> --}}
      </nav>
    @endif
  </div>
</header>
