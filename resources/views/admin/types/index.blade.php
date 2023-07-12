@extends('admin.layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $type = session('delete_success') @endphp
        <div class="alert alert-danger mt-3">
            Type "{{ $type->name }}" deleted
        </div>
    @endif

    <div class="card mt-3 p-2">
        <div class="card-body">

            <div class="d-inline-block">
                <h1>Types</h1>
                <hr class="rounded">
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Count</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <th scope="row">{{ $type->id }}</th>
                            <td>{{ $type->name }}</td>
                            <td>{{ count($type->projects) }}</td>
                            <td>
                                <a class="btn btn-outline-info"
                                    href="{{ route('admin.types.show', ['type' => $type->id]) }}">&#8505;</a>
                                <a class="btn btn-outline-light"
                                    href="{{ route('admin.types.edit', ['type' => $type->id]) }}">✏️</a>
                                @if ($type->id != 1)
                                    <button class="btn btn-outline-warning js-delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="{{ $type->id }}">&#128465;</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure ?</h1>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action=""
                                        data-template="{{ route('admin.types.destroy', ['type' => '*****']) }}"
                                        method="post" class="d-inline-block" id="confirm-delete">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </tbody>
            </table>
        </div>
    </div>
@endsection
