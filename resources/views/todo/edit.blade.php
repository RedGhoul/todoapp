<x-layout>
    <div class="container">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Todo - {{$todo->title}}
            </h2>
        </header>

        <form method="POST" action="/todo/{{$todo->id}}/update" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="input-field col s12">
                    <h5>Title</h5>
                    <input
                        type="text"
                        name="title"
                        placeholder="Add Title of todo"
                        class="validate"
                        value="{{$todo->title}}"
                    />
                    @error('title')
                    <p>{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <h5>Content</h5>
                    <div id="editor"></div>
                    <textarea id="text_area_main" hidden name="content">
                        {{$todo->content}}
                    </textarea>
                </div>
            </div>
            <div class="mb-6">
                <button class="btn-large">
                    Update Todo
                </button>

                <a href="/todo/all" class="btn-large"> Back </a>
            </div>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then(editor => {
                editor.setData(`{!! $todo->content !!}`);
                editor.model.document.on('change:data', (evt, data) => {
                    document.getElementById('text_area_main').value = editor.getData();
                });
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-layout>
