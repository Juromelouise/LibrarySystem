@extends('layout.master')
@section('title')
    New York Sanctuary
@endsection

@section('content')
<style>
    .images {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
</style>
@if (Auth::user() && Auth::user()->role === '1')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PendingBooks as $pending)
                        <tr>
                            <td>{{ $pending->user->name }}</td>
                            <td class="titles">
                                @foreach ($pending->books as $book)
                                {{ $book->title }}
                                <br /><br><br>
                                @endforeach
                            </td>
                            <td class="images">
                                @foreach ($pending->books as $book)
                                <img src="{{ asset($book->imgpath) }}" alt="" width="50px" height="50px">
                                @endforeach
                            </td>
                            <td>{{ $pending->due_date }}</td>
                            <td>{{ $pending->status }}</td>
                            <td>
                                <a href="{{ route('order.confirm', $pending->id) }}" class="btn btn-success">Confirm Borrow</a>
                                <a href="{{ route('order.cancel', $pending->id) }}" class="btn btn-danger">Cancel Borrow</a>
                            </td>
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
