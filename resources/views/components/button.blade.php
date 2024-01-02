@php
  $realsize = 'px-5 py-2.5 text-sm';
  $type = $attributes['type'] ?? 'button';
  $size = $attributes['size'] ?? 'md';
  switch ($size) {
      case 'md':
          $realsize = 'px-5 py-2.5 text-sm';
          break;
      case 'lg':
          $realsize = 'px-5 py-3 text-base';
          break;
      case 'xl':
          $realsize = 'px-6 py-3.5 text-base';
          break;
  }
@endphp
@if ($type == 'button')
  <button
    {{ $attributes->merge(['class' => 'bg-primary-500 hover:bg-primary-600 focus:ring-primary-300 dark:focus:ring-primary-900 font-medium uppercase text-white focus:outline-none focus:ring-4 transition ' . $realsize]) }}
  >
    {{ $slot }}
  </button>
@endif

@if ($type == 'submit')
  <button
    type="submit"
    {{ $attributes->merge(['class' => 'bg-primary-500 hover:bg-primary-600 focus:ring-primary-300 dark:focus:ring-primary-900 font-medium uppercase text-white focus:outline-none focus:ring-4 transition ' . $realsize]) }}
  >
    {{ $slot }}
  </button>
@endif

@if ($type == 'link')
  <a
    {{ $attributes->merge(['class' => 'bg-primary-500 hover:bg-primary-600 focus:ring-primary-300 dark:focus:ring-primary-900 font-medium uppercase text-white focus:outline-none focus:ring-4 transition inline-block ' . $realsize]) }}>
    {{ $slot }}
  </a>
@endif
