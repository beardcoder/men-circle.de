@php($logo = '/assets/web/images/logo.png')

<footer class="bg-secondary p-4 text-white md:p-8 lg:p-10">
  <div class="mx-auto max-w-screen-xl text-center">

    <a
      class="mx-auto block h-20 w-20"
      href="/"
    >
      <img
        class="h-full w-auto"
        src="{{ URL::asset($logo) }}"
        alt="logo"
        width="500"
        height="500"
      />
      <span class="sr-only">Startseite</span>
    </a>
    <p class="my-6">
      {{ TwillAppSettings::get('homepage.homepage.footer') }}
    </p>
    <ul class="mb-6 flex flex-wrap items-center justify-center dark:text-white">
      <li>
        <a
          class="mr-4 hover:underline md:mr-6"
          href="mailto:info@mens-circle.de"
        >Kontakt</a>
      </li>
      <li>
        <a
          class="mr-4 hover:underline md:mr-6"
          href="https://www.instagram.com/markus.sommer/"
        >
          Instagram
        </a>
      </li>

    </ul>
    <span class="text-sm sm:text-center">© 2023-{{ now()->year }} Build with ❤️ and
      mindfulness in Bavaria</span>
  </div>
</footer>
