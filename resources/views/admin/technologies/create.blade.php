@extends('admin.layouts.base')

@section('contents')
    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1>Add New Technology</h1>
                <hr class="rounded">
            </div>

            <form method="post" action="{{ route('admin.technologies.store') }}" novalidate>
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">
                        <h4 class="my-0">Name</h4>
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
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
