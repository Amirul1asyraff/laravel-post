@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Post Card -->
            <div class="card mb-4">

                <div class="card-header">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back to Home</a>
                </div>

                <div class="card-body">
                    <div class="form-group mb-3">

                        <label for="caption" class="mb-2">Caption</label>
                        <input name="caption" type="text" class="form-control" id="caption" value="{{ $post->caption }}" readonly>
                    </div>
                    <small class="text-muted">Posted {{ $post->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <!-- Comments Section -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Comments</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">
                        Leave a comment
                    </button>


<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Leave a Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('comment.store', $post) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="text" class="form-label">Your comment</label>
                        <textarea name="text" class="form-control" id="text" rows="3" placeholder="Share your thoughts..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
                </div>
                <div class="card-body">
                    @if($post->comments->count() > 0)
                        @foreach($post->comments as $comment)
                            <div class="comment-item border-bottom pb-3 mb-3">
                                <p class="mb-1">{{ $comment->text }}</p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">By {{ $comment->user->name ?? 'Unknown' }}</small>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted my-4">No comments yet. Be the first to comment!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
