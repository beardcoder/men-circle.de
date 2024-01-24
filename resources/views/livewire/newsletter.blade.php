<div>

  @if ($success === true)
    <div class="format lg:format-lg dark:format-invert max-w-none text-center">
      Vielen Dank für deine Anmeldung ich werde mich bald mit dir in Verbindung setzen
    </div>
  @else
    <form
      class="mx-auto max-w-md space-y-8"
      wire:submit.prevent="register"
      method="POST"
    >
      @csrf
      @honeypot
      <div data-aos="fade-up">
        <label
          class="mb-2 block text-sm font-medium text-stone-900 dark:text-stone-300"
          for="name"
        >Dein Name</label>
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
      <div data-aos="fade-up">
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
      <div data-aos="fade-up">
        <x-button
          class="block w-full"
          type="submit"
          size="md"
        >
          Jetzt Anmelden
        </x-button>
      </div>
    </form>
  @endif

</div>
