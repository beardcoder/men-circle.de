<section
  class="bg-stone-100 dark:bg-stone-900"
  id="contact"
>
  <div class="mx-auto max-w-screen-md px-4 py-8 lg:py-16">
    <h2
      class="mb-4 text-center text-4xl font-extrabold tracking-tight text-stone-900 dark:text-white"
      data-apper
    >
      {!! $block->input('title') !!}
    </h2>
    @if ($block->input('text'))
      <p
        class="mb-8 text-center font-light text-stone-500 dark:text-stone-400 sm:text-xl lg:mb-16"
        data-apper
      >
        {!! $block->input('text') !!}
      </p>
    @endif
    <form
      class="mx-auto max-w-md space-y-8"
      action="{{ route('subscription.signup') }}"
      method="POST"
    >
      @csrf
      @honeypot
      <div data-apper>
        <label
          class="mb-2 block text-sm font-medium text-stone-900 dark:text-stone-300"
          for="name"
        >Dein Name</label>
        <input
          class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light block w-full border border-stone-300 bg-stone-50 p-2.5 text-sm text-stone-900 shadow-sm dark:border-stone-600 dark:bg-stone-700 dark:text-white dark:placeholder-stone-400"
          id="name"
          name="name"
          type="text"
          placeholder="Christian Baumer"
          required
        >
      </div>
      <div data-apper>
        <label
          class="mb-2 block text-sm font-medium text-stone-900 dark:text-stone-300"
          for="email"
        >Deine Email</label>
        <input
          class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light block w-full border border-stone-300 bg-stone-50 p-2.5 text-sm text-stone-900 shadow-sm dark:border-stone-600 dark:bg-stone-700 dark:text-white dark:placeholder-stone-400"
          id="email"
          name="email"
          type="email"
          placeholder="christian.baumer@mens-circle.de"
          required
        >
      </div>

      <x-button
        class="block w-full"
        data-apper
        type="submit"
        size="md"
      >Jetzt Anmelden</x-button>
    </form>
  </div>
</section>
