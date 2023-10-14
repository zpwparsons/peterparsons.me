<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-mono bg-slate-100 dark:bg-vulcan text-slate-600 dark:text-slate-400">
        <div class="min-h-screen flex flex-col justify-center items-center">
            <div class="text-8xl text-blue-600 dark:text-lime-400 font-semibold tracking-wider">
                @yield('code')
            </div>

            <div class="mt-4 text-2xl uppercase tracking-wider">
                @yield('message')
            </div>
        </div>

        <script>
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                if (localStorage.theme === 'system') {
                    if (e.matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }

                updateThemeAndSchemeColor();
            });

            function updateTheme() {
                if (!('theme' in localStorage)) {
                    localStorage.theme = 'system';
                }

                switch (localStorage.theme) {
                    case 'system':
                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                        document.documentElement.setAttribute('color-theme', 'system');
                        break;

                    case 'dark':
                        document.documentElement.classList.add('dark');
                        document.documentElement.setAttribute('color-theme', 'dark');
                        break;

                    case 'light':
                        document.documentElement.classList.remove('dark');
                        document.documentElement.setAttribute('color-theme', 'light');
                        break;
                }

                updateThemeAndSchemeColor();
                hideButtonsBasedOnTheme();
            }

            function updateThemeAndSchemeColor() {
                const isDark = document.documentElement.classList.contains('dark');

                document.querySelector('meta[name="color-scheme"]').setAttribute('content', isDark ? 'dark' : 'light');
                document.querySelector('meta[name="theme-color"]').setAttribute('content', isDark ? '#171923' : '#ffffff');
            }

            function hideButtonsBasedOnTheme() {
                const theme = localStorage.theme;

                const sunButton = document.getElementById('header__sun');
                const moonButton = document.getElementById('header__moon');
                const systemButton = document.getElementById('header__system');

                switch (theme) {
                    case 'system':
                        systemButton.style.display = 'block';
                        sunButton.style.display = 'none';
                        moonButton.style.display = 'none';
                        break;

                    case 'dark':
                        systemButton.style.display = 'none';
                        sunButton.style.display = 'none';
                        moonButton.style.display = 'block';
                        break;

                    case 'light':
                        systemButton.style.display = 'none';
                        sunButton.style.display = 'block';
                        moonButton.style.display = 'none';
                        break;
                }
            }

            updateTheme();
        </script>
    </body>
</html>
