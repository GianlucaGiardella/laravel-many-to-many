@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>{{ $type->name }}</h1>
                <hr class="border border-2 rounded border-light">
            </div>
            <p>{{ $type->description }}</p>

            <h3>Type's Posts</h3>
            <ul>
                @foreach ($type->projects as $project)
                    <li><a href="{{ route('admin.projects.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
