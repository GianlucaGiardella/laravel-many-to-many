@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>{{ $technology->name }}</h1>
                <hr class="rounded">
            </div>

            <h3>Projects using {{ $technology->name }}:</h3>
            <ul>
                @foreach ($technology->projects as $project)
                    <li class="mt-2"><a
                            href="{{ route('admin.projects.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
