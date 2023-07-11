@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>Edit Project</h1>
                <hr class="border border-2 rounded border-light">
            </div>

            <form method="post" action="{{ route('admin.projects.update', ['project' => $project]) }}" novalidate>
                @csrf
                @method('put')

                <div class="mb-4">
                    <label for="title" class="form-label">
                        <h4 class="my-0">Title</h4>
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $project->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- <div class="mb-4">
                    <label for="url_image" class="form-label"><h4 class="my-0">Image</h4></label>
                    <input type="url" class="form-control @error('url_image') is-invalid @enderror" id="url_image"
                        name="url_image" value="{{ old('url_image', $project->url_image) }}">
                    @error('url_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}

                <div class="mb-4">
                    <label for="content" class="form-label">
                        <h4 class="my-0">Content</h4>
                    </label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="5" name="content">{{ old('content', $project->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="type" class="form-label">
                        <h4 class="my-0">Type</h4>
                    </label>
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

                <div class="mb-4">
                    <h4 class="my-1">Technologies</h4>
                    @foreach ($technologies as $technology)
                        <div class="mb-1 form-check">
                            <input type="checkbox" class="form-check-input" id="technology{{ $technology->id }}"
                                name="technologies[]" value="{{ $technology->id }}"
                                @if (in_array($technology->id, old('technologies', $project->technologies->pluck('id')->all()))) checked @endif>
                            <label class="form-check-label"
                                for="technology{{ $technology->id }}">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div>

                <button class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
@endsection
