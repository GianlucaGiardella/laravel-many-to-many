@extends('admin.layouts.base')

@section('contents')
    <h1>{{ $project->title }}</h1>
    <h3>Category: {{ $project->type->name }}</h3>
    <h3>Technologies: {{ implode(', ', $project->technologies->pluck('name')->all()) }}</h3>
    <img src="{{ $project->url_image }}" alt="{{ $project->title }}">
    <p>{{ $project->content }}</p>
@endsection
