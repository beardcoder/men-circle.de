@if (flash()->message)
  <div class="fixed top-0 right-0 p-5 w-full max-w-sm z-[1000]">
    <div
      id="toast-default"
      class="flex items-center p-4 text-stone-900 bg-white shadow dark:text-stone-100 dark:bg-stone-700"
      role="alert"
    >
      <div class="ms-3 text-base mr-3">
        {!! flash()->message !!}
      </div>
      <button
        type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-stone-400 hover:text-stone-900 focus:ring-2 focus:ring-stone-300 p-1.5 hover:bg-stone-100 inline-flex items-center justify-center h-8 w-8 dark:text-stone-500 dark:hover:text-white dark:bg-stone-800 dark:hover:bg-stone-700 flex-none"
        data-dismiss-target="#toast-default"
        aria-label="Close"
      >
        <span class="sr-only">Close</span>
        <svg
          class="w-3 h-3"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 14"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
          />
        </svg>
      </button>
    </div>
  </div>
@endif
