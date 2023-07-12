@extends('admin.layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $project = session('delete_success') @endphp
        <div class="alert alert-danger mt-3">
            Project "{{ $project->title }}" deleted
        </div>
    @endif

    <div class="card mt-3 p-2">

        <div class="card-body">
            <div class="d-inline-block">
                <h1 class="text-light">Projects</h1>
                <hr class="rounded">
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-light">ID</th>
                        <th scope="col" class="text-light">Title</th>
                        <th scope="col" class="text-light">Type</th>
                        <th scope="col" class="text-light">Technologies</th>
                        <th scope="col" class="text-light">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row"><span class="text-gradient">{{ $project->id }}</span></th>
                            <td>{{ $project->title }}</td>
                            <td><a
                                    href="{{ route('admin.types.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a>
                            </td>
                            <td>
                                @foreach ($project->technologies as $technology)
                                    <a
                                        href="{{ route('admin.technologies.show', ['technology' => $technology]) }}">{{ $technology->name }}</a>
                                    {{ !$loop->last ? '|' : '' }}
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-outline-info"
                                    href="{{ route('admin.projects.show', ['project' => $project]) }}">&#8505;</a>
                                <a class="btn btn-outline-light"
                                    href="{{ route('admin.projects.edit', ['project' => $project]) }}">✏️</a>
                                <button class="btn btn-outline-warning js-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $project->slug }}">&#128465;</button>
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
                                        data-template="{{ route('admin.projects.destroy', ['project' => '*****']) }}"
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

            {{ $projects->links() }}
        </div>
    </div>
@endsection
