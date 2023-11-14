@php($color = 'text-black')
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
        class="{{ $color }} h-full w-auto"
        src="{{ URL::asset($logo) }}"
        alt="logo"
        width="500"
        height="500"
      />
      <span class="sr-only">Startseite</span>
    </a>
    <nav class="{{ $color }} mx-auto mt-2 flex space-x-8 text-xl font-bold uppercase md:mr-0 md:mt-0">
      <a href="/">Home</a>
      <a href="/#contact">Anmeldung</a>
      <a href="/#faq">FAQ's</a>
      {{-- <a href="/impressum">Impressum</a> --}}
    </nav>
  </div>
</header>
