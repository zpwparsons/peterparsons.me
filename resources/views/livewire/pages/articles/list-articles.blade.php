<div>
    <div class="max-w-2xl w-full mx-auto flex-1">
        <h1 class="font-bold text-3xl text-slate-900 dark:text-white">
            Articles
        </h1>

        <hr class="my-8 dark:border-slate-600">

        <div class="space-y-12">
            @foreach($articles as $article)
                <article>
                    <h2 class="font-bold text-lg">
                        <x-app.link href="{{ route('articles:show', $article) }}" class="hover:underline">
                            {{ $article->title }}
                        </x-app.link>
                    </h2>

                    <div class="flex items-center gap-x-3 mt-2">
                        <time datetime="2023-06-14 00:00:00" class="text-slate-400 dark:text-slate-500 text-sm block">
                            {{ $article->formatted_created_at }}
                        </time>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>
