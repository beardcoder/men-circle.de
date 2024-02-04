@php
  $block = cache()->rememberForever('footer', function () {
      return TwillAppSettings::getGroupDataForSectionAndName('homepage', 'footer');
  });
@endphp
<footer class="bg-secondary p-4 text-white md:p-8 lg:p-10">
  <div class="mx-auto max-w-screen-xl text-center">
    <p class="my-6">
      {{ TwillAppSettings::get('homepage.footer.text') }}
    </p>
    <x-footer-menu />
    <span class="text-sm sm:text-center">
      © 2023-{{ now()->year }} Build with ❤️ and
      mindfulness in Bavaria</span>
  </div>
</footer>
