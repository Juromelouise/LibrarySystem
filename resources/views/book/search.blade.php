@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<h1>Search</h1>

There are {{ $searchResults->count() }} results.

@foreach($searchResults->groupByType() as $type => $modelSearchResults)
   <h2>{{ $type }}</h2>
   
   @foreach($modelSearchResults as $searchResult)
       <ul>
            <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
       </ul>
   @endforeach
@endforeach
@endsection
