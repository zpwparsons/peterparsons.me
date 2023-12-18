<div class="flex flex-col flex-grow border-r border-slate-200 dark:border-vulcan bg-white dark:bg-mirage overflow-y-auto">
    <div class="sticky top-0 z-10 flex items-center flex-shrink-0 py-3 px-2 bg-white dark:bg-mirage opacity-90">
        <x-app.link href="{{ route('home') }}" class="w-full py-1 px-2">
            <h1 class="text-2xl font-bold text-blue-600 dark:text-lime-500">
                Peter Parsons
            </h1>
        </x-app.link>
    </div>

    <div class="flex-grow flex flex-col">
        <nav class="mt-5 flex-1 px-2 space-y-8 bg-white dark:bg-mirage" aria-label="Sidebar">
            <div class="space-y-2">
                <x-app.nav-link :route="route('home')" :active="request()->routeIs('home')">
                    <span class="text-slate-400 dark:text-slate-500 mr-3 flex-shrink-0 h-4 w-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                    </span>
                    Home
                </x-app.nav-link>

                <x-app.nav-link :route="route('articles.list')" :active="request()->routeIs('articles*')">
                    <span class="text-slate-400 dark:text-slate-500 mr-3 flex-shrink-0 h-4 w-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                            <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                        </svg>
                    </span>
                    Articles
                </x-app.nav-link>

                <h3 class="pt-8 pb-2 px-3 text-xs sm:text-sm font-semibold text-slate-400 uppercase tracking-wider">
                    Me
                </h3>

                <x-app.nav-link :route="route('uses')" :active="request()->routeIs('uses')">
                    <span class="text-slate-400 dark:text-slate-500 mr-3 flex-shrink-0 h-4 w-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                              <path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75zM4.117 19.125a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008z" clip-rule="evenodd" />
                              <path d="M10.076 8.64l-2.201-2.2V4.874a.75.75 0 00-.364-.643l-3.75-2.25a.75.75 0 00-.916.113l-.75.75a.75.75 0 00-.113.916l2.25 3.75a.75.75 0 00.643.364h1.564l2.062 2.062 1.575-1.297z" />
                              <path fill-rule="evenodd" d="M12.556 17.329l4.183 4.182a3.375 3.375 0 004.773-4.773l-3.306-3.305a6.803 6.803 0 01-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 00-.167.063l-3.086 3.748zm3.414-1.36a.75.75 0 011.06 0l1.875 1.876a.75.75 0 11-1.06 1.06L15.97 17.03a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Uses
                </x-app.nav-link>

                <h3 class="pt-8 pb-2 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Online
                </h3>

                <x-app.external-nav-link href="https://x.com/PW_Parsons">
                    <span class="text-slate-400 dark:text-slate-500 mr-3 flex-shrink-0 h-4 w-4">
                        <svg width="17" height="17" viewBox="0 0 24 24" aria-hidden="true">
                            <g><path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g>
                        </svg>
                    </span>
                    Twitter

                    <span class="text-slate-500 dark:text-slate-600 group-hover:text-blue-600 dark:group-hover:text-lime-500 mr-1 ml-auto flex-shrink-0 h-3 w-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 9" fill="none">
                            <path d="M9.00195 6.32617V0.824219C9.00195 0.490234 8.79102 0.267578 8.45117 0.267578L2.94922 0.279297C2.62109 0.279297 2.41016 0.519531 2.41016 0.794922C2.41016 1.07031 2.65039 1.30469 2.92578 1.30469H4.66602L7.45508 1.19922L6.39453 2.13672L1.16211 7.38086C1.05664 7.48633 0.998047 7.61523 0.998047 7.73828C0.998047 8.01367 1.24414 8.27734 1.53125 8.27734C1.66602 8.27734 1.78906 8.22461 1.89453 8.11914L7.13281 2.875L8.07617 1.81445L7.96484 4.48047V6.34961C7.96484 6.61914 8.19922 6.86523 8.48633 6.86523C8.76172 6.86523 9.00195 6.63672 9.00195 6.32617Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </x-app.external-nav-link>

                <x-app.external-nav-link href="https://github.com/zpwparsons">
                    <span class="text-slate-400 dark:text-slate-500 mr-3 flex-shrink-0 h-4 w-4">
                        <svg viewBox="0 0 17 16" width="15" height="15" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <path fillrule="evenodd" cliprule="evenodd" d="M8.06478 0C3.61133 0 0 3.6722 0 8.20248C0 11.8266 2.31081 14.9013 5.51518 15.9859C5.91823 16.0618 6.06622 15.808 6.06622 15.5913C6.06622 15.3957 6.05875 14.7496 6.05528 14.0642C3.81164 14.5604 3.3382 13.0963 3.3382 13.0963C2.97134 12.1483 2.44275 11.8961 2.44275 11.8961C1.71103 11.387 2.49791 11.3975 2.49791 11.3975C3.30775 11.4552 3.73417 12.2428 3.73417 12.2428C4.45347 13.4968 5.62083 13.1343 6.08103 12.9247C6.15342 12.3947 6.36245 12.0325 6.59305 11.8278C4.80178 11.6204 2.91872 10.9171 2.91872 7.77405C2.91872 6.87851 3.23377 6.14679 3.74966 5.57235C3.66593 5.36561 3.38987 4.53148 3.8278 3.40163C3.8278 3.40163 4.50501 3.18118 6.04619 4.24243C6.68951 4.0607 7.37942 3.96953 8.06478 3.96644C8.75018 3.96953 9.44062 4.0607 10.0851 4.24243C11.6244 3.18118 12.3007 3.40163 12.3007 3.40163C12.7397 4.53148 12.4635 5.36561 12.3798 5.57235C12.8969 6.14679 13.2098 6.87851 13.2098 7.77405C13.2098 10.9245 11.3231 11.6182 9.52728 11.8213C9.81657 12.0758 10.0743 12.575 10.0743 13.3403C10.0743 14.4377 10.065 15.321 10.065 15.5913C10.065 15.8096 10.2101 16.0653 10.6189 15.9848C13.8216 14.899 16.1294 11.8254 16.1294 8.20248C16.1294 3.6722 12.5187 0 8.06478 0Z"></path>
                        </svg>
                    </span>
                    Github

                    <span class="text-slate-500 dark:text-slate-600 group-hover:text-blue-600 dark:group-hover:text-lime-500 mr-1 ml-auto flex-shrink-0 h-3 w-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 9" fill="none">
                            <path d="M9.00195 6.32617V0.824219C9.00195 0.490234 8.79102 0.267578 8.45117 0.267578L2.94922 0.279297C2.62109 0.279297 2.41016 0.519531 2.41016 0.794922C2.41016 1.07031 2.65039 1.30469 2.92578 1.30469H4.66602L7.45508 1.19922L6.39453 2.13672L1.16211 7.38086C1.05664 7.48633 0.998047 7.61523 0.998047 7.73828C0.998047 8.01367 1.24414 8.27734 1.53125 8.27734C1.66602 8.27734 1.78906 8.22461 1.89453 8.11914L7.13281 2.875L8.07617 1.81445L7.96484 4.48047V6.34961C7.96484 6.61914 8.19922 6.86523 8.48633 6.86523C8.76172 6.86523 9.00195 6.63672 9.00195 6.32617Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </x-app.external-nav-link>
            </div>
        </nav>
    </div>
</div>
