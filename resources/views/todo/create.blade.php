<x-layout>
    <style>
        .ck-editor__editable {
            min-height: 200px !important;
        }
    </style>
    <div class="container">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create A Todo
            </h2>
        </header>

        <form method="POST" action="/todo/store" accept-charset="utf-8" >
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <h5>Title</h5>
                    <input
                        type="text"
                        name="title" value="{{old('title')}}"
                    />
                    @error('title')
                     <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <h5>Content</h5>
                    <div id="editor"></div>
                    <textarea
                        id="text_area_main"
                        hidden
                        name="content"
                    ></textarea>
                </div>
            </div>
            <div class="mb-6">
                <button type="submit" class="btn-large">
                    Create Todo
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
                editor.model.document.on('change:data', (evt, data) => {
                    document.getElementById('text_area_main').value = editor.getData();
                });
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-layout>
