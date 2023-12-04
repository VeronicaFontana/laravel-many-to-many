@extends("layouts.admin")

@section("content")

        @if (session("success"))
        <div class="alert alert-success" role="alert">
            {{ session("success") }}
        </div>
        @endif

        <h1>Lista Tecnologie per Progetto</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome progetto</th>
                    <th scope="col">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tecnology->projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>
                            <a class="btn btn-info mb-1" href="{{ route("admin.projects.show", $project) }}"><i class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                            @include("admin.partials.form-delete",[
                            "route" => route("admin.projects.destroy", $project),
                            "message" => "Sei sicuro di voler eliminare questo progetto?"
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
