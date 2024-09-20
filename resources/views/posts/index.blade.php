@extends('layouts.app')

@section('content')
<main>
    @include('sidebar_layout')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white border-0">
                        <i class="fa fa-list"></i> {{ __('Posts List') }}
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <h4 class="mb-4">Create New Post</h4>
                        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" id="title" name="title" class="form-control form-control-lg border-primary" placeholder="Enter the title" />
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="body" class="form-label">Body:</label>
                                <textarea id="body" class="form-control form-control-lg border-primary" name="body" rows="5" placeholder="Write your post here"></textarea>
                                @error('body')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="text-end">
                                <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Submit</button>
                            </div>
                        </form>
                        
                        <h4 class="mt-5 mb-4">Post List:</h4>
                        
                        @foreach($posts as $post)
                            <div class="card mb-4 shadow-sm border-light rounded-lg overflow-hidden">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <!-- User Profile Image -->
                                        <div class="me-3">
                                            <img src="images/admin2.gif" alt="User Image" class="rounded-circle border border-secondary" width="70" height="70">
                                        </div>
                                        <div>
                                            <h5 class="card-title mb-1">{{ $post->title }}</h5>
                                            <p class="text-muted mb-2">
                                                By {{ $post->user_name }} | {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="card-text mb-3">{{ $post->body }}</p>
                                    <div class="text-end">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View Post</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
