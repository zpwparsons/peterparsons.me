<a
    {{ $attributes->except(['class', 'rel', 'target']) }}
    {{ $attributes->merge(['class' => 'underline underline-offset-2 text-blue-600 dark:text-lime-500 outline-none focus:no-underline focus:ring focus:ring-offset-2 focus:bg-slate-100 focus:ring-offset-slate-100 dark:focus:bg-vulcan/70 dark:focus:ring-offset-vulcan focus:ring-blue-600 dark:focus:ring-lime-500 rounded-md']) }}
    target="_blank"
    rel="noopener noreferrer"
>{{ $slot }}</a>

