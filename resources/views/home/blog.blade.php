@extends('layout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Tin tức mới nhất</h2>
    <div class="row">
        @foreach($news as $blog)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                    <a href="{{ route('user.showDetailBlog', $blog->id) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
