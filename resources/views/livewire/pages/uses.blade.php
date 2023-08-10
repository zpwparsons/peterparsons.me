<x-app.prose>
    @foreach($tools as $tool)
        <h2>{{ $tool->category }}</h2>

        {!! $tool->formatted_description !!}
    @endforeach
</x-app.prose>
