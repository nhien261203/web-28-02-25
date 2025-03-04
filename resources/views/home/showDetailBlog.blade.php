@extends('layout')

@section('content')
<img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid" alt="{{ $blog->title }}" width="100%">
<div class="container mt-4 text-center">
    <h2>{{ $blog->title }}</h2>
    <p class="text-muted fst-italic">{{ $blog->created_at->format('H:i d/m/Y') }}</p>


    <p class="mt-3">{{ $blog->content }}</p>
</div>
@endsection
