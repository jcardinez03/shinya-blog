@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row mt-2 mb-3">
            <div class="col-4">
                <i class="fas fa-image fa-10x d-block text-center"></i>
                <input type="file" name="avatar" id="avatar" class="form-control mt-1" aria-describedby="avatar-info">
                <div class="form-text" id="avatar-info">
                    Acceptable formats: jpeg, jpg, png, gif only<br>
                    Maximum file size: 1048kb
                </div>
                {{-- ERROR --}}
            </div>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label text-muted">Name</label>
            <input type="text" name="name" id="name" class="form-control">
            {{-- Error --}}
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label text-muted">Email Address</label>
            <input type="text" name="email" id="email" class="form-control">
            {{-- Error --}}
        </div>

        <button type="submit" class="btn btn-warning px-5">Save</button>
    </form>
@endsection