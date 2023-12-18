<div>
    @seo(['title' => 'Articles'])

    @if($articles->count())
        <div class="max-w-2xl w-full mx-auto flex-1">
            <h1 class="font-bold text-2xl lg:text-3xl text-slate-900 dark:text-white">
                Articles

                @if($this->selectedTag)
                    <span>
                        ({{ $this->selectedTag->name }})
                    </span>
                @endif
            </h1>

            <hr class="my-8 dark:border-slate-700">

            <div class="space-y-12">
                @foreach($articles as $article)
                    <article>
                        <h1 class="font-bold text-lg lg:text-xl">
                            <x-app.link href="{{ route('articles.show', $article) }}" class="text-blue-600 dark:text-lime-500 hover:underline">
                                {{ $article->title }}
                            </x-app.link>
                        </h1>

                        <p class="my-3 text-sm lg:text-base">
                            {{ $article->excerpt }}
                        </p>

                        <div class="flex items-center gap-x-4 mt-2">
                            <time datetime="2023-06-14 00:00:00" class="text-slate-400 dark:text-slate-500 text-xs lg:text-sm block">
                                {{ $article->formatted_published_date }}
                            </time>

                            <div class="flex gap-x-2">
                                @foreach($article->tags as $tag)
                                    <x-app.link
                                        href="{{ route('articles.list', ['tag' => $tag->slug]) }}"
                                        class="text-xs hover:no-underline font-medium text-slate-900 dark:text-slate-300 bg-slate-200 dark:bg-madison/50 inline-block px-2 py-1 rounded-lg"
                                    >
                                        {{ $tag->name }}
                                    </x-app.link>
                                @endforeach
                            </div>
                        </div>
                    </article>
                @endforeach

                {{ $articles->links('components.app.pagination') }}
            </div>
        </div>
    @else
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-center text-slate-900 dark:text-white">
                Articles Archive Awaits its Stories!
            </h1>

            <p class="mt-12">
                It seems we've arrived in an area yet to be filled with tales and knowledge. This shelf is ready to
                host a collection of insights, experiences, and wisdom that I'm eager to share. Stay tuned for an
                assortment of narratives, advice, and discoveries that narrate my digital expeditions.
            </p>

            <p class="mt-8">
                Craving inspiration? Delve into my <x-app.link href="{{ route('uses') }}" class="text-blue-600 dark:text-lime-500">tools and resources</x-app.link>
                or a peek into my digital toolbox.
            </p>
        </div>
    @endif
</div>
