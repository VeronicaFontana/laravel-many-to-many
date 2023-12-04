@extends("layouts.admin")

@section("content")

    <h1 class="mb-4">{{ $name }}</h1>

    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="mb-3">
            <label for="name" class="form-label">Titolo</label>
            <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name", $project?->name) }}">
            @error("name")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" onchange="showImage(event)" class="form-control @error("image") is-invalid @enderror" id="image" name="image" value="{{ old("image", $project?->image) }}">
            @error("image")
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <img id="thumb" width="150" onerror="this.src='/img/placeholder.webp'  src="{{ asset('storage/' . $project?->image) }}" />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea id="description" class="form-control" name="description" style="height: 200px" >{{ old('description',$project?->description) }}</textarea>
            @error("description")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="creation_date" class="form-label">Data di creazione</label>
            <input type="text" class="form-control @error("creation_date") is-invalid @enderror" id="creation_date" name="creation_date"value="{{ old("creation_date", $project?->creation_date) }}">
            @error("creation_date")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Tipologia</label>
            <select class="form-select" name="type_id" id="type_id">
                <option value="">Selezionare una tipologia di progetto</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old("type_id", $project?->type_id) == $type->id? "selected" : "" }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Invia</button>
        <button type="reset" class="btn btn-secondary">Annulla</button>
    </form>

    <script>
        ClassicEditor
            .create( document.querySelector( "#description" ) )
            .catch( error => {
                console.error( error );
            } );

        function showImage(event){
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

@endsection
