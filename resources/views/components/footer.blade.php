@php($logo = '/assets/web/images/logo.png')

<footer class="bg-white p-4 dark:bg-gray-800 md:p-8 lg:p-10">
  <div class="mx-auto max-w-screen-xl text-center">

    <a
      class="mx-auto block h-20 w-20"
      href="/"
    >
      <img
        class="h-full w-auto"
        src="{{ URL::asset($logo) }}"
        width="500"
        height="500"
      />
    </a>
    <p class="my-6 text-gray-500 dark:text-gray-400">Some Text</p>
    <ul class="mb-6 flex flex-wrap items-center justify-center text-gray-900 dark:text-white">
      <li>
        <a
          class="mr-4 hover:underline md:mr-6"
          href="/impressum"
        >Impressum</a>
      </li>
      <li>
        <a
          class="mr-4 hover:underline md:mr-6"
          href="#contact"
        >Kontakt</a>
      </li>
      <li>
        <a
          class="mr-4 hover:underline md:mr-6"
          href="https://www.instagram.com/markus.sommer/"
        >Instagram</a>
      </li>

    </ul>
    <span class="text-sm text-gray-500 dark:text-gray-400 sm:text-center">© 2023-{{ now()->year }} Build with ❤️ and
      mindfulness in Bavaria</span>
  </div>
</footer>
