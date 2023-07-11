@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">

            <div class="d-inline-block">
                <h2>Project N.{{ $project->id }}</h2>
                <hr class="border border-2 rounded border-light">
            </div>

            <h1>{{ $project->title }}</h1>
            <h3>Category: {{ $project->type->name }}</h3>
            <h3>Technologies: {{ implode(', ', $project->technologies->pluck('name')->all()) }}</h3>
            {{-- <img src="{{ $project->url_image }}" alt="{{ $project->title }}"> --}}
            <p>Description: {{ $project->content }}</p>

        </div>
    </div>
@endsection
