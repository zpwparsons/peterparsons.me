@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        <span>
            @if (! $paginator->onFirstPage())
                <x-app.link
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="relative inline-flex items-center px-4 py-2.5 text-sm text-blue-600 dark:text-lime-400 bg-white dark:bg-mirage border border-slate-200 dark:border-slate-700 leading-5 rounded-md focus:outline-none focus:ring ring-slate-300 focus:border-blue-300 active:bg-slate-100 active:text-slate-700"
                >
                    {!! __('pagination.previous') !!}
                </x-app.link>
            @endif
        </span>

        {{-- Next Page Link --}}
        <span>
            @if ($paginator->hasMorePages())
                <x-app.link
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="relative inline-flex items-center px-4 py-2.5 text-sm text-blue-600 dark:text-lime-400 bg-white dark:bg-mirage border border-slate-200 dark:border-slate-700 leading-5 rounded-md focus:outline-none focus:ring ring-slate-300 focus:border-blue-300 active:bg-slate-100 active:text-slate-700"
                >
                    {!! __('pagination.next') !!}
                </x-app.link>
            @endif
        </span>
    </nav>
@endif
