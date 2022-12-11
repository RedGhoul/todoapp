<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless(count($todos) == 0)
            @foreach($todos as $todo)
                <x-listing-card :todo="$todo"></x-listing-card>
            @endforeach
        @else
            <p>No listings found</p>
        @endunless
    </div>
    <div class="mt-6 p-4">
        {{$todos->links()}}
    </div>
</x-layout>


