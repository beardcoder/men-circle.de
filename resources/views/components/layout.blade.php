<!doctype html>
<html
  class="scroll-smooth"
  lang="{{ app()->getLocale() }}"
>

<head>
  {!! SEOMeta::generate() !!}
  <meta charset="utf-8" />
  <meta
    http-equiv="X-UA-Compatible"
    content="IE=edge"
  />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1"
  />
  @vite('resources/css/app.css')
</head>

<body>
  <x-header />
  {{ $slot }}
  <x-footer />
  @vite(['resources/js/app.js'])
</body>

</html>
