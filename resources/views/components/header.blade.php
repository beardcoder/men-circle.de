@php($color = 'text-black')
@php($absolute = '')
@php($logo = '/assets/web/images/logo.png')

@if (Request::path() == 'startseite' || Request::path() == '/')
  @php($color = 'text-white')
  @php($absolute = 'absolute')
@endif

<header class="{{ $absolute }} top-0 z-20 h-20 w-full">
  <div class="mx-auto flex h-20 max-w-screen-xl items-center px-2 py-2">
    <a
      class="block h-full"
      href="/"
    >
      <img
        class="{{ $color }} h-full w-auto"
        src="{{ URL::asset($logo) }}"
        width="500"
        height="500"
      />
    </a>
    <nav class="{{ $color }} ml-auto flex space-x-8 text-xl font-bold uppercase">
      <a href="/">Home</a>
      <a href="/#contact">Kontakt</a>
      <a href="/impressum">Impressum</a>
    </nav>
  </div>
</header>
