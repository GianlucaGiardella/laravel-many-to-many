@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>Edit Type</h1>
                <hr class="rounded">
            </div>


            <form method="post" action="{{ route('admin.types.update', ['type' => $type]) }}" novalidate>
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="name" class="form-label">
                        <h4 class="my-0">Name</h4>
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $type->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">
                        <h4 class="my-0">Description</h4>
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                        name="description">{{ old('description', $type->description) }}</textarea>
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
