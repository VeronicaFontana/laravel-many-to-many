@extends("layouts.admin")

@section("content")

        @if (session("success"))
        <div class="alert alert-success" role="alert">
            {{ session("success") }}
        </div>
        @endif

        <h1>Lista Tipologie per Progetto</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome Tipologia</th>
                    <th scope="col">Titolo Progetto</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td><b>{{ $type->name }}</b></td>
                        <td>
                            <ul class="list-group">
                                @foreach ($type->projects as $project)
                                    <li class="list-group-item"><a href="{{ route("admin.projects.show", $project) }}">{{ $project->name }}</a></li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection
