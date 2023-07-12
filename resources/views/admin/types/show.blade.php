@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>{{ $type->name }}</h1>
                <hr class="rounded">
            </div>

            <div class="mt-3">
                <h3>Description</h3>
                <p>{{ $type->description }}</p>
            </div>

            <div class="mt-4">
                <h3>Latest Posts</h3>
                <ul>
                    @foreach ($type->projects()->orderBy('created_at', 'DESC')->get() as $project)
                        <li class="mb-2"><a
                                href="{{ route('admin.projects.show', ['project' => $project]) }}">{{ $project->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
