@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Dashboard') }}</span>
                        <a href="{{ route('post.create') }}" class="btn btn-primary">Create Post</a>
                    </div>
                    <div class="card-body">
                        @forelse($posts as $post)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <h5 class=" mb-0">{{ $post->User->name }}</h5>
                                    </div>
                                     <div class="card">
                                         <p class="card-text fs-4">{{ $post->caption }}</p>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <a href="{{ route('post.show', $post) }}" class="btn btn-primary me-2">Show</a>
                                            <a href="{{ route('post.edit', $post) }}" class="btn btn-primary me-2">Edit</a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $post->id }}">
                                                Delete
                                            </button>

                                     </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="deleteModalLabel{{ $post->id }}">Confirm Delete
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            Are you sure you want to delete this item {{ $post->caption }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('post.destroy', $post) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-warning" role="alert">
                                No data found
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
