@props([
    'route',
    'active' => false,
])

<x-app.link
    href="{{ $route }}"
    class="
        group flex items-center px-3 py-2 text-sm font-medium rounded-md sm:text-base
        {{
            $active
                ? 'text-blue-600 dark:text-lime-500 bg-slate-100 dark:bg-vulcan'
                : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-vulcan hover:text-slate-900'
        }}
    "
>{{ $slot }}</x-app.link>

