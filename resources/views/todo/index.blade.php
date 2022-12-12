<x-layout>
    @include('partials._search')
    <div class="container">
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
                @unless(count($todos) == 0)
                    @foreach($todos as $todo)
                        <tr>
                            <td><a href="/todo/{{$todo['id']}}/show">{{$todo->title}}</a></td>
                            <td>{{$todo->created_at}}</td>
                            <td>
                                <a class="btn" href="/todo/{{$todo['id']}}/edit">Edit</a>
                                <form class="inline" method="POST" action="/todo/{{$todo['id']}}/destroy">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">
                                        <i class="fa-solid fa-door-closed"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <h2>No Todos Found</h2>
                @endunless

            </tbody>
        </table>

    </div>
    <div class="mt-6 p-4">
        {{$todos->links()}}
    </div>
</x-layout>


