<a
    wire:navigate
    @keydown.enter="Alpine.navigate($event.target.href)"
    {{ $attributes->except(['wire:navigate', 'class']) }}
    {{ $attributes->merge(['class' => 'underline-offset-2 outline-none focus:no-underline focus:ring focus:ring-offset-2 focus:bg-slate-100 focus:ring-offset-slate-100 dark:focus:bg-vulcan/70 dark:focus:ring-offset-vulcan focus:ring-blue-600 dark:focus:ring-lime-500 rounded-md']) }}
>{{ $slot }}</a>

