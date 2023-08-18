<div>
    @if($tools->count())
        <x-app.prose>
            @foreach($tools as $tool)
                <h2>{{ $tool->category }}</h2>

                {!! $tool->formatted_description !!}
            @endforeach
        </x-app.prose>
    @else
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-center text-slate-900 dark:text-white">
                Toolbox Awaits its Treasures!
            </h1>

            <p class="mt-12">
                Looks like we've ventured into uncharted territory! This toolshed is waiting to
                be stocked with digital wonders that fuel my creations. Check back soon for an
                array of enchantments, gadgets, and resources that power my digital escapades.
            </p>

            <p class="mt-8">
                Feeling curious? Explore my <x-app.link href="{{ route('articles:list') }}" class="text-blue-600 dark:text-lime-500">articles</x-app.link>
                for insights and tips from my digital journey.
            </p>
        </div>
    @endif
</div>
