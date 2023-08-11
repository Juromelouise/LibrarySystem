@extends('layout.master')

@section('title')
  New York Sanctuary
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/search.css') }}">
@endsection
@section('content')
<style>

</style>

<div class="container">
    <div class="search-results">
        @if( $searchResults->count()>1)
        <p class="search-header">There are {{ $searchResults->count() }} results.</p>
        @else
        <p class="search-header">There are {{ $searchResults->count() }} result.</p>
        @endif
        @foreach($searchResults->groupByType() as $modelSearchResults)
           <div class="result-type">Books
           </div>

           <ul class="result-list">
               @foreach($modelSearchResults as $searchResult)
                   <li class="result-item">
                       <a class="result-link" href="{{ $searchResult->url }}">-{{ $searchResult->title }}</a>
                   </li>
               @endforeach
           </ul>
        @endforeach
    </div>
</div>
@endsection
