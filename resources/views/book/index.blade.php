@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
{{-- @if (Auth::user() && Auth::user()->role === '1') --}}
<div class="container">
  {{-- <a href="{{route('book.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;">Add Book</a> --}}
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
<table id="bookTable" class="table">
    <thead>
      <tr>
        <th scope="col">Book Name</th>
         <th scope="col">Image</th>
         <th scope="col">Genre</th>
        <th scope="col">Author Name</th>
        <th scope="col">Date Released</th>
        <th scope="col">Action</th>
        </ul>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
          </div>
      </div>
  </div>
</div>
<script src="{{ asset('/js/book.js') }}"></script>
{{-- @else
<p>Access denied. You must be an admin to view this page.</p>
@endif --}}
@endsection