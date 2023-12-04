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
                </tr>
                </thead>
                <tbody>
                @foreach ($tecnology->projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection
