@props(['todo'])

<x-card>
    <div class="flex">

        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$todo['id']}}">{{$todo->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$todo->content}}</div>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$todo->created_at}}
            </div>
        </div>
    </div>
</x-card>
