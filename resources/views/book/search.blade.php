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
    <h1>Search  </h1>

    <div class="search-results">
        <p class="search-header">There are {{ $searchResults->count() }} results.</p>

        @foreach($searchResults->groupByType() as $modelSearchResults)
        {{-- {{dd($searchResults);}} --}}
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
