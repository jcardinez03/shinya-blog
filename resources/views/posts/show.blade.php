@extends('layouts.app')

@section('title', 'Show')

@section('content')

 <div class="mt border border-2 rounded p-4 shadow-sm">
    <h2 class="h4">{{ $post->title }}</h2>
    <h3 class="h6 text-secondary">{{ $post->user->name }}</h3>
    <p>{{ $post->body }}</p>

    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-100 shadow rounded">
 </div>

 <form action="{{ route('comment.store', $post->id) }}" method="post">
    @csrf
    <div class="input-group mt-5">
        <input type="text" name="comment" id="comment" placeholder="Add a comment..." class="form-control" value="{{ old('comment') }}">
        <button type="submit" class="btn btn-outline-secondary btn-sm">
            <i class="fa-regular fa-paper-plane"></i> Post
        </button>
    </div>

    {{-- ERROR --}}
    @error('comment')
        <p class="text-danger small">{{ $message }}</p>
    @enderror
 </form>

 {{-- Show all the comments of the post --}}
 @if ($post->comments)
     <div class="mt-2 mb-5">
        @foreach ($post->comments as $comment)
            <div class="row p-2">
                <div class="col-10">
                    <span class="fw-bold">{{ $comment->user->name }}</span>
                    &nbsp;
                    <span class="small text-muted">{{ $comment->created_at }}</span>
                    <p class="mb-0">{{ $comment->body }}</p>
                </div>

                <div class="col-2 text-end">
                    {{-- Show a delete button if the Auth user is the owner of the comment --}}
                    @if ($comment->user_id === Auth::user()->id)
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" title="Delete comment">
                                <i class="fas fa-trash-can"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
     </div>
 @endif
@endsection