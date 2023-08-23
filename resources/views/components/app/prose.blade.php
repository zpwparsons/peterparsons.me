<div>
    <article class="prose prose-blue dark:prose-dark prose-md lg:prose-lg prose-pre:bg-white prose-pre:text-slate-500 dark:prose-pre:text-slate-400 dark:prose-pre:bg-mirage text-slate-500 dark:text-slate-400 prose-h1:text-2xl lg:prose-h1:text-3xl prose-a:text-blue-600 dark:prose-a:text-lime-500 prose-headings:text-slate-900 dark:prose-headings:text-white prose-strong:text-slate-500 dark:prose-strong:text-slate-400">
        {{ $slot }}
    </article>

    <footer>
        <div class="mt-16 text-center">
            <p class="text-sm">
                Code highlighted by <x-app.external-link href="https://torchlight.dev/">Torchlight</x-app.external-link>
            </p>
        </div>
    </footer>
</div>
