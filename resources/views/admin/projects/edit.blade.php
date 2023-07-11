@extends('admin.layouts.base')

@section('contents')
    <h1>Edit Project</h1>

    <form method="post" action="{{ route('admin.projects.update', ['project' => $project]) }}" novalidate>
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="url_image" class="form-label">Image</label>
            <input type="url" class="form-control @error('url_image') is-invalid @enderror" id="url_image"
                name="url_image" value="{{ old('url_image', $project->url_image) }}">
            @error('url_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="3" name="content">{{ old('content', $project->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select @error('type_id') is-invalid @enderror" id="type" name="type_id">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id', $project->type->id) == $type->id) selected @endif>
                        {{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <h3>Technologies</h3>
            @foreach ($technologies as $technology)
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="technology{{ $technology->id }}"
                        name="technologies[]" value="{{ $technology->id }}"
                        @if (in_array($technology->id, old('technologies', $project->technologies->pluck('id')->all()))) checked @endif>
                    <label class="form-check-label" for="technology{{ $technology->id }}">{{ $technology->name }}</label>
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
