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
  <link
    type="image/svg+xml"
    href="/favicon.svg"
    rel="icon"
  >
  <link
    type="image/png"
    href="/favicon.png"
    rel="icon"
  >
  @vite('resources/css/app.css')

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://mens-circle.de/",
      "logo": "https://mens-circle.de/assets/web/images/logo.png"
    }
    </script>
</head>

<body>
  <x-header />
  {{ $slot }}
  <x-footer />
  @vite(['resources/js/app.js'])
</body>

</html>
