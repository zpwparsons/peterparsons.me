<div
    x-data="{ open: false }"
    @keydown.window.escape="open = false"
    class="sticky top-0 z-10 flex h-14 bg-white dark:bg-mirage border-b border-slate-200 dark:border-mirage"
>
    <!-- Mobile navigation start -->
    <button
        @click="open = true"
        type="button"
        class="px-4 text-slate-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-600 dark:focus:ring-lime-500 lg:hidden"
    >
        <span class="sr-only">Open sidebar</span>
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div
        x-show="open"
        class="relative z-50 lg:hidden"
        x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state."
        x-ref="dialog"
        aria-modal="true"
    >
        <div
            x-show="open"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/80"
            x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state."
        ></div>

        <div class="fixed inset-0 flex">
            <div
                x-show="open"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                class="relative mr-16 flex w-full max-w-xs flex-1"
                @click.away="open = false"
            >
                <div
                    x-show="open"
                    x-transition:enter="ease-in-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in-out duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-description="Close button, show/hide based on off-canvas menu state."
                    class="absolute left-full top-0 flex w-16 justify-center pt-5"
                >
                    <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <x-app.navigation />
            </div>
        </div>
    </div>
    <!-- Mobile navigation end -->

    <div class="flex-1 px-4 flex justify-end">
        <livewire:components.app.search />

        <div class="ml-4 flex items-center">
            <x-app.theme />
        </div>
    </div>
</div>
