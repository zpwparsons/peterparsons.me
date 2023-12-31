<div
    x-data="{
        query: @entangle('query'),
        open: false,
        selectedResult: -1,
        openSearch() {
            this.open = true;
        },
        closeSearch() {
            this.open = false;
            this.query = '';
            this.selectedResult = -1;
        },
        focusSelectedResult() {
            const listItem = document.getElementById('result-' + this.selectedResult);
            if (!listItem) return;
            listItem.scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'nearest'});
            listItem.focus();
        }
    }"
    x-init="$watch('query', () => this.selectedResult = 0)"
    @keyup.slash.window="openSearch"
    @keyup.meta.k.window="openSearch"
    @keyup.ctrl.k.window="openSearch"
    @keyup.down.window.prevent="selectedResult == {{ $results->count() }} - 1 ? selectedResult = 0 : selectedResult++; focusSelectedResult();"
    @keyup.up.window.prevent="selectedResult == 0 ? selectedResult = {{ $results->count() }} - 1 : selectedResult--; focusSelectedResult();"
    class="flex"
>
    <button
        @click="openSearch"
        type="button"
        class="p-1 rounded-md text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 focus:outline-none focus:ring focus:ring-offset-2 dark:focus:ring-offset-mirage focus:ring-blue-600 dark:focus:ring-lime-500"
    >
        <span class="sr-only">Search</span>
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
    </button>

    @teleport('body')
        <div
            x-show="open"
            x-trap="open"
            class="relative z-10"
            aria-labelledby="search-input-label"
            role="dialog"
            aria-modal="true"
        >
            <div
                x-transition:enter="ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-description="Background backdrop, show/hide based on search panel state."
                class="fixed inset-0 bg-black-pearl/50 backdrop-blur transition-opacity"
            ></div>

            <div class="fixed inset-0 overflow-y-auto px-4 py-4 sm:px-6 sm:py-20 md:py-32 lg:px-8 lg:py-[15vh]">
                <div
                    x-show="open"
                    @click.away="closeSearch"
                    @keyup.escape.window="closeSearch"
                    x-transition:enter="ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-description="Search panel, show/hide based on search panel state."
                    class="mx-auto transform-gpu overflow-hidden rounded-xl bg-white shadow-xl dark:bg-slate-800 dark:ring-1 dark:ring-slate-700 sm:max-w-2xl"
                >
                    <div role="combobox" aria-expanded="false" aria-haspopup="listbox" aria-labelledby="search-label">
                        <header>
                            <form action="" novalidate="" role="search">
                                <div class="group relative flex h-14">
                                    <label for="search-input" id="search-input-label" class="sr-only">Search</label>
                                    <svg aria-hidden="true" viewBox="0 0 20 20" class="pointer-events-none absolute left-4 top-0 h-full w-5 fill-slate-400 dark:fill-slate-500">
                                        <path d="M16.293 17.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM9 14a5 5 0 0 1-5-5H2a7 7 0 0 0 7 7v-2ZM4 9a5 5 0 0 1 5-5V2a7 7 0 0 0-7 7h2Zm5-5a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7v2Zm8.707 12.293-3.757-3.757-1.414 1.414 3.757 3.757 1.414-1.414ZM14 9a4.98 4.98 0 0 1-1.464 3.536l1.414 1.414A6.98 6.98 0 0 0 16 9h-2Zm-1.464 3.536A4.98 4.98 0 0 1 9 14v2a6.98 6.98 0 0 0 4.95-2.05l-1.414-1.414Z"></path>
                                    </svg>
                                    <input
                                        wire:model.live="query"
                                        x-ref="searchInput"
                                        class="flex-auto appearance-none bg-transparent pl-12 text-slate-900 text-sm lg:text-base outline-none placeholder:text-slate-400 focus:w-full focus:flex-none dark:text-white [&amp;::-webkit-search-cancel-button]:hidden [&amp;::-webkit-search-decoration]:hidden [&amp;::-webkit-search-results-button]:hidden [&amp;::-webkit-search-results-decoration]:hidden pr-4"
                                        aria-autocomplete="both"
                                        aria-labelledby="search-label"
                                        id="search-input"
                                        type="search"
                                        autofocus
                                        autocomplete="off"
                                        autocorrect="off"
                                        autocapitalize="off"
                                        enterkeyhint="search"
                                        spellcheck="false"
                                        placeholder="Find something..."
                                        maxlength="512"
                                        tabindex="0"
                                    >
                                </div>
                            </form>
                        </header>

                        <template x-if="query.length">
                            <ul class="max-h-[32rem] overflow-y-auto border-t border-slate-200 dark:border-slate-600 leading-6" role="listbox">
                                @forelse ($results as $index => $result)
                                    <li role="option" tabindex="-1">
                                        <x-app.link
                                            id="result-{{ $index }}"
                                            x-bind:class="selectedResult == {{ $index }} ? 'bg-slate-100 dark:bg-vulcan/50' : 'hover:bg-slate-100 dark:hover:bg-vulcan/50'"
                                            class="block p-4 m-2.5 rounded-lg outline-none"
                                            href="{{ $result->url }}"
                                        >
                                            <h2
                                                x-html="@js($result->title()).replace(/({{ $query }})/gi, '<strong class=\'border-b border-blue-600 dark:border-lime-500\'>$1</strong>')"
                                                class="text-blue-600 dark:text-lime-500 font-semibold"
                                            >
                                                {{ $result->title() }}
                                            </h2>

                                            <p
                                                x-html="@js($result->entry).replace(/({{ $query }})/gi, '<strong class=\'border-b border-slate-600 text-blue-600 dark:border-lime-500 dark:text-lime-500\'>$1</strong>')"
                                                class="mt-1.5 text-xs lg:text-sm font-normal"
                                            >
                                                {!! $result->highlightedSnippet() !!}
                                            </p>
                                        </x-app.link>
                                    </li>
                                @empty
                                    <li class="flex items-center justify-center p-4" role="option" tabindex="-1" aria-selected="false">
                                        <span class="px-2 sm:px-16 py-20 text-center">
                                            <h2 class="font-bold">No results found</h2>

                                            <p class="mt-3 leading-6 text-slate-400 dark:text-slate-500 text-xs lg:text-sm">
                                                Oops! No luck finding what you're after. How about trying a different keyword?
                                            </p>
                                        </span>
                                    </li>
                                @endforelse
                            </ul>
                        </template>

                        <template x-if="query.length">
                            <footer class="hidden md:block border-t border-slate-200 dark:border-slate-600">
                                <ul class="p-3 flex justify-between">
                                    <li class="flex items-center">
                                        <kbd class="ml-1.5 rounded font-mono leading-6 py-0.5 px-1.5 bg-slate-200 dark:bg-madison">
                                            <svg width="15" height="15" aria-label="Enter key" role="img">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2">
                                                    <path d="M12 3.53088v3c0 1-1 2-2 2H4M7 11.53088l-3-3 3-3"></path>
                                                </g>
                                            </svg>
                                        </kbd>
                                        <span class="ml-2 text-xs">to select</span>
                                    </li>

                                    <li class="flex items-center">
                                        <kbd class="ml-1.5 rounded font-mono leading-6 py-0.5 px-1.5 bg-slate-200 dark:bg-madison">
                                            <svg width="15" height="15" aria-label="Arrow down" role="img">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2">
                                                    <path d="M7.5 3.5v8M10.5 8.5l-3 3-3-3"></path>
                                                </g>
                                            </svg>
                                        </kbd>
                                        <kbd class="ml-1.5 rounded font-mono leading-6 py-0.5 px-1.5 bg-slate-200 dark:bg-madison">
                                            <svg width="15" height="15" aria-label="Arrow up" role="img">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2">
                                                    <path d="M7.5 11.5v-8M10.5 6.5l-3-3-3 3"></path>
                                                </g>
                                            </svg>
                                        </kbd>
                                        <span class="ml-2 text-xs">to navigate</span>
                                    </li>

                                    <li class="flex items-center">
                                        <kbd class="ml-1.5 rounded font-mono leading-6 py-0.5 px-1.5 bg-slate-200 dark:bg-madison">
                                            <svg width="15" height="15" aria-label="Escape key" role="img">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2">
                                                    <path d="M13.6167 8.936c-.1065.3583-.6883.962-1.4875.962-.7993 0-1.653-.9165-1.653-2.1258v-.5678c0-1.2548.7896-2.1016 1.653-2.1016.8634 0 1.3601.4778 1.4875 1.0724M9 6c-.1352-.4735-.7506-.9219-1.46-.8972-.7092.0246-1.344.57-1.344 1.2166s.4198.8812 1.3445.9805C8.465 7.3992 8.968 7.9337 9 8.5c.032.5663-.454 1.398-1.4595 1.398C6.6593 9.898 6 9 5.963 8.4851m-1.4748.5368c-.2635.5941-.8099.876-1.5443.876s-1.7073-.6248-1.7073-2.204v-.4603c0-1.0416.721-2.131 1.7073-2.131.9864 0 1.6425 1.031 1.5443 2.2492h-2.956"></path>
                                                </g>
                                            </svg>
                                        </kbd>
                                        <span class="ml-2 text-xs">to close</span>
                                    </li>
                                </ul>
                            </footer>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    @endteleport
</div>
