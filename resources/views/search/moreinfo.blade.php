@extends('layout.master')

@section('title')
  New York Sanctuary
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/moreinfo.css') }}">
@endsection
@section('content')
<div class="container book-info-container">
    <h1>Book Information</h1>
    <div class="book-info">
        <h3>Title: {{ $books->title }}</h3>
        @if(count($books->media) > 0)
        <img class="book-img" src="{{ $books->media[0]?->original_url }}" alt="Book Cover">
        @else
        <img class="book-img" src="{{ $books->imgpath }}" alt="Book Cover">
        @endif
        <p>Author: {{ $books->author->name }}</p>
        <p>Date Released: {{ $books->date_released }}</p>
        <p>Genre: {{ $books->genre->genre_name }}</p>
    </div>
</div>
@endsection
