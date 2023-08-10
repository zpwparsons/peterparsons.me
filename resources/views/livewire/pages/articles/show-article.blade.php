<div>
    @seo([
        'title' => $article->title,
        'description' => 'Some article description',
    ])

    <x-app.prose>
        <h1>{{ $article->title }}</h1>

        <div class="text-slate-400 dark:text-slate-500 text-xs lg:text-sm">
            <time datetime="{{ $article->created_at }}">
                {{ $article->formatted_created_at }}
            </time>

            <span>
                 -  2 minutes Read
            </span>
        </div>

        {!! $article->formatted_content !!}
    </x-app.prose>
</div>
