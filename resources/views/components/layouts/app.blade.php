<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="theme-color" content="#ffffff">
        <meta name="color-scheme" content="light">
        <x-seo::meta />

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative h-full overflow-hidden font-mono bg-slate-100 dark:bg-vulcan text-slate-600 dark:text-slate-400">
        <!-- Desktop navigation start -->
        <div data-no-index class="hidden lg:flex lg:w-72 lg:flex-col lg:fixed lg:inset-y-0">
            <x-app.navigation />
        </div>
        <!-- Desktop navigation end -->

        <div class="lg:pl-72 flex flex-col flex-1">
            <div class="flex overflow-hidden">
                <div class="w-full">
                    <div data-no-index>
                        <x-app.top-bar />
                    </div>

                    <main class="flex-1 relative z-0 h-screen overflow-y-auto focus:outline-none xl:order-last px-6 lg:px-8 py-4 lg:py-10">
                        <div class="mt-6 mb-20 max-w-2xl mx-auto">
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
