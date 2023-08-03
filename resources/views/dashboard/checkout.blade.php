@extends('layout.master')

@section('title')
    New York Sanctuary
@endsection

@section('styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (!Session::get('checkout') == [] && Session::has('checkout'))
        <div class="row">
            <div class="col-sm-12">
                <table class="table" id="checkoutTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkout as $item)
                            <tr>
                                <td>{{ $item['title'] }}</td>
                                <td><img src="{{ asset($item['img_path']) }}" alt="{{ $item['title'] }}"
                                        style="max-height: 100px;"></td>
                                <td>
                                    <button class="btn btn-success minusQuantity" data-id="{{ $item['id'] }}">-</button>
                                    <span id="quantity">{{ $item['quantity'] }}</span>
                                    <button class="btn btn-success addQuantity" data-id="{{ $item['id'] }}">+</button>
                                </td>
                                <td>
                                    <a href="{{ route('checkout.remove', $item['id']) }}" class="btn btn-danger">Remove</a>
                                    {{-- <a href="{{ route('reduce', $item['id']) }}" class="btn btn-danger">Reduce Quantity by
                                        1</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#checkoutModal">Borrow</button>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <h2>No Items in Cart!</h2>
                </div>
            </div>
    @endif
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLongTitle">Borrow</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="return_date">Due Date</label>
                    <input type="date" class="form-control" id="return_date" name="return_date"
                        min="{{ Carbon\Carbon::now()->addDays(1)->format('Y-m-d') }}"
                        max="{{ Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="borrowSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/checkout.js') }}" defer></script>
@endsection

{{-- @section('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
@endsection --}}
