@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">

            <div class="d-inline-block">
                <h2 class="text-light">Project N.{{ $project->id }}</h2>
                <hr class="rounded">
            </div>

            <div class="mt-4">
                <h3 class="text-light d-inline-block">Project Title: </h3>
                <h1 class="d-inline-block">{{ $project->title }}</h1>
            </div>

            <div class="mt-4">
                <h3 class="text-light d-inline-block">Author: </h3>
                <h2 class="d-inline-block">{{ $project->author }}</h2>
            </div>

            @if ($project->image)
                <div class="mt-4">
                    <h3 class="text-light">Image: </h3>
                    <img class="d-block" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                        style="max-width: 600px">
                </div>
            @endif

            <div class="mt-4">
                <h3 class="text-light d-inline-block">GitHub URL: </h3>
                <h3 class="d-inline-block"><a href="{{ $project->github_url }}">{{ $project->github_url }}</a></h3>
            </div>

            <div class="mt-4">
                <h3 class="text-light d-inline-block">Category: </h3>
                <h3 class="d-inline-block">
                    <a href="{{ route('admin.types.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a>
                </h3>
            </div>

            <div class="mt-4">
                <h3 class="text-light d-inline-block">Technologies: </h3>
                <h3 class="d-inline-block">
                    @foreach ($project->technologies as $technology)
                        <a
                            href="{{ route('admin.technologies.show', ['technology' => $technology]) }}">{{ $technology->name }}</a>
                        {{ !$loop->last ? '|' : '' }}
                    @endforeach
                </h3>
            </div>

            <div class="mt-4">
                <h3 class="text-light">Description: </h3>
                <p>{{ $project->description }}</p>
            </div>

        </div>
    </div>
@endsection
