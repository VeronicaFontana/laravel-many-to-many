@extends("layouts.admin")

@section("content")

        <h1>Lista Tipologie</h1>
        <div class="w-50 my-3">

            @if(session("error"))
                <div class="alert alert-danger" role="alert">
                    {{session("error")}}
                </div>
            @endif

            @if(session("success"))
                <div class="alert alert-success" role="alert">
                    {{session("success")}}
                </div>
            @endif

            <form action="{{ route("admin.types.store") }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nuova tecnologia" name="name">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Crea</button>
                </div>
            </form>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>
                                <form
                                    action="{{ route("admin.types.update", $type) }}"
                                    method="POST"
                                    id="form-edit"
                                >
                                    @csrf
                                    @method("PUT")
                                    <input type="text" class="form-hidden" value="{{ $type->name }}" name="name" />
                                </form>
                            </td>
                            <td>
                                <button onclick="submitForm()" class="btn btn-warning" id="button-addon2"><i class="fa-solid fa-pencil"></i></button>
                                @include("admin.partials.form-delete",[
                                    "route" => route("admin.types.destroy", $type),
                                    "message" => "Sei sicuro di voler eliminare questa tecnologia?"
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            function submitForm(){
                const form = document.getElementById("form-edit");
                form.submit();
            }
        </script>

@endsection
