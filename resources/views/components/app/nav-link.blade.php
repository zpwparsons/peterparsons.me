@props([
    'route',
    'active' => false,
])

<x-app.link
    href="{{ $route }}"
    class="
        group flex items-center px-2 py-2 text-sm font-medium rounded-md
        {{
            $active
                ? 'text-blue-600 dark:text-lime-500 bg-slate-100 dark:bg-madison/50'
                : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-madison/50 hover:text-slate-900 dark:hover:text-slate-300'
        }}
    "
    {{ $attributes->merge(['class']) }}
>
    {{ $slot }}
</x-app.link>
