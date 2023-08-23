<a
    {{ $attributes->except(['class', 'rel', 'target']) }}
    target="_blank"
    rel="noopener noreferrer"
    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md sm:text-base text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-vulcan hover:text-slate-900 outline-none focus:ring focus:ring-offset-2 focus:bg-slate-100 focus:ring-offset-slate-100 dark:focus:bg-vulcan/70 dark:focus:ring-offset-vulcan focus:ring-blue-600 dark:focus:ring-lime-500"
>{{ $slot }}</a>

