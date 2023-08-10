<div>
    @seo([
        'title' => $article->title,
        'description' => 'Some article description',
    ])

    <x-app.prose>
        {!! $article->formatted_content !!}
    </x-app.prose>
</div>
