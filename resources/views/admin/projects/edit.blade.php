@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>Edit Project</h1>
                <hr class="rounded">
            </div>

            <form method="post" action="{{ route('admin.projects.update', ['project' => $project]) }}"
                enctype="multipart/form-data" novalidate>
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

                <div class="mb-4">
                    <label for="author" class="form-label">
                        <h4 class="my-0">Author</h4>
                    </label>
                    <input type="url" class="form-control @error('author') is-invalid @enderror" id="author"
                        name="author" value="{{ old('author', $project->author) }}">
                    @error('author')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <label class="input-group-text  @error('image') is-invalid @enderror" for="image">Upload</label>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="github_url" class="form-label">
                        <h4 class="my-0">GitHub URL</h4>
                    </label>
                    <input type="url" class="form-control @error('github_url') is-invalid @enderror" id="github_url"
                        name="github_url" value="{{ old('github_url', $project->github_url) }}">
                    @error('github_url')
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

                <div class="mb-4">
                    <label for="description" class="form-label">
                        <h4 class="my-0">Description</h4>
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="5"
                        name="description">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
@endsection
