<div
    x-data="{
        query: @entangle('query'),
        open: false,
        selectedHit: 0,
        toggle() {
            this.open = ! this.open;
            this.query = '';
        },
    }"
    x-init="$watch('query', () => this.selectedHit = 0)"
    @keyup.slash.window="toggle"
    @keyup.meta.k.window="toggle"
    @keyup.ctrl.k.window="toggle"
    @keyup.down.window.prevent="selectedHit == {{ $results->count() }} - 1 ? selectedHit = 0 : selectedHit++; document.getElementById('hit-' + selectedHit).scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'nearest'}); document.getElementById('hit-' + selectedHit).focus();"
    @keyup.up.window.prevent="selectedHit == 0 ? selectedHit = {{ $results->count() }} - 1 : selectedHit--; document.getElementById('hit-' + selectedHit).scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'nearest'}); document.getElementById('hit-' + selectedHit).focus();"
    class="flex"
>
    <button
        @click="open = true"
        type="button"
        class="p-1 rounded-full text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 focus:outline-none focus:ring-0"
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
                    @click.away="toggle"
                    @keyup.escape.window="toggle"
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
                                    autocomplete="off"
                                    autocorrect="off"
                                    autocapitalize="off"
                                    enterkeyhint="search"
                                    spellcheck="false"
                                    placeholder="Find something..."
                                    maxlength="512"
                                    type="search"
                                    tabindex="0"
                                >
                            </div>
                        </form>

                        @if ($query !== '')
                            <ul class="max-h-[32rem] overflow-y-auto rounded-b-lg border-t border-slate-200 dark:border-slate-600 leading-6" role="listbox">
                                @forelse ($results as $index => $result)
                                    <li role="option" tabindex="-1">
                                        <x-app.link
                                            id="hit-{{ $index }}"
                                            x-bind:class="selectedHit == {{ $index }} ? 'bg-slate-100 dark:bg-vulcan/50 ring ring-blue-600 dark:ring-lime-500' : 'ring-0 hover:bg-slate-100 dark:hover:bg-vulcan/50'"
                                            class="block p-4 m-2.5 rounded-lg outline-none focus:bg-slate-100 focus:dark:bg-vulcan/50 focus:ring focus:ring-blue-600 dark:focus:ring-lime-500"
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endteleport
</div>
