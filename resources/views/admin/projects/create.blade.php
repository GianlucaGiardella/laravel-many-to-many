@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>Add New Project</h1>
                <hr class="rounded">
            </div>


            <form method="post" action="{{ route('admin.projects.store') }}" novalidate>
                @csrf

                <div class="mb-4">
                    <label for="title" class="form-label">
                        <h4 class="my-0">Title</h4>
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}">
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
                        name="author" value="{{ old('author') }}">
                    @error('author')
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
                        name="github_url" value="{{ old('github_url') }}">
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
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                                @if (in_array($technology->id, old('technologies', []))) checked @endif>
                            <label class="form-check-label"
                                for="technology{{ $technology->id }}">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">
                        <h4 class="my-0">Description</h4>
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                        name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>
@endsection
