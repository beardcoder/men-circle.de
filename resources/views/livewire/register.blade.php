@props(['id' => ''])

<form
  class="space-y-8"
  wire:submit="register"
  method="POST"
>
  @csrf
  @honeypot
  <input
    name="appointment"
    type="hidden"
    value="{{ $id }}"
  />
  <div data-fade="left">
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
      wire:model="name"
      placeholder="Christian Baumer"
      required
    >
  </div>
  <div data-fade="left">
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
      wire:model="email"
      placeholder="christian.baumer@mens-circle.de"
      required
    >
  </div>

  <div
    class="mb-4 flex items-center"
    data-fade="left"
  >
    <input
      class="text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-2 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800"
      id="newsletter"
      type="checkbox"
      value="true"
      wire:model="email"
    >
    <label
      class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
      for="newsletter"
    >Ich möchte regelmässige infos zum Männerkreis erhalten</label>
  </div>

  <x-button
    class="block w-full"
    data-fade="left"
    type="submit"
    size="md"
  >Jetzt Anmelden</x-button>
</form>
