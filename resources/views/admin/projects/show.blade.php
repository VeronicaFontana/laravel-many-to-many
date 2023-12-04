@php
    use App\Function\Helper;
@endphp

@extends("layouts.admin")

@section("content")

        <h1>{{ $project->name }}</h1>
        <div class="card my-4" style="width: 18rem;">
            <img src="{{ asset("storage/" . $project->image) }}" alt="{{ $project->name }}">
            <p>{{ $project->image_original_name }}</p>
            <div class="card-body">
                <h5 class="card-title">{{ $project->name }}</h5>
                <p class="card-text">{!! $project->description !!}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Creato il:</b> {{ Helper::formatDate($project->date) }}</li>
                @if ($project->type)
                    <li class="list-group-item"><b>Tipologia:</b> {{ $project->type->name }}</li>
                @endif

            </ul>
            <div class="card-body">
                <a class="btn btn-warning" href="{{ route("admin.projects.edit", $project) }}" class="card-link"><i class="fa-solid fa-pencil"></i></a>
            </div>
        </div>

@endsection
