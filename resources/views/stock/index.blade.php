@extends('layout.master')

@section('title')
    New York Sanctuary
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/author.css') }}">
@endsection
@section('content')
    @if (Auth::user() && Auth::user()->role === '1')
    <div class="container-fluid">
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="position:absolute; top:9.5%; width: 95%;">
            You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <table id="stockTable" class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Book</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Edit Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCUstock" tabindex="-1" role="dialog" aria-labelledby="modalCUstockTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCUstockLongTitle">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="stockForm">
                    <div class="form-group">
                        <label class="col-form-label" id= "book-label" for="inputWarning">Book Title</label>
                        <select class="form-control" id="book-select" placeholder="Enter ..." name="book_id">
                            <option class="dont-clear" value="">
                                Select Book
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Enter Stock</label>
                        <input type="number" class="form-control" id="stock" placeholder="Enter Stock"
                            name="stock">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="save" type="button" class="btn btn-primary">Save</button>
                <button id="update" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
    <script src="{{ asset('/js/stock.js') }}"></script>
    @else
        <p>Access denied. You must be an admin to view this page.</p>
    @endif
@endsection
