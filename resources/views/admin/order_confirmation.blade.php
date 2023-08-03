@extends('layout.master')
@section('title')
    New York Sanctuary
@endsection

@section('content')
    @if (Auth::user() && Auth::user()->role === '1')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PendingBooks as $pending)
                                    <tr>
                                        <td>{{ $pending->name }}</td>
                                        <td>{{ $pending->title }}</td>
                                        <td><img src="{{url($pending->imgpath)}}" alt="" width="50px" height="50px"></td>
                                        <td>{{ $pending->due_date }}</td>
                                        <td>{{ $pending->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Access denied. You must be an admin to view this page.</p>
    @endif
@endsection
