@extends('layout.master')

@section('title')
    New York Sanctuary
@endsection

@section('content')
    <style>
        #checkoutTable {
            text-align: center;
            margin-top: 50px;
            letter-spacing: 2px;
        }

        #checkoutTable thead tr th {
            font-weight: 500;
            letter-spacing: 2px;
        }

        #checkoutTable tbody button {
            font-weight: 900;
        }
    </style>
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
                                {{-- <td>
                                    <input type="date" class="form-control" id="return_date" name="return_date"
                                        min="{{ Carbon\Carbon::now()->addDays(1)->format('Y-m-d') }}"
                                        max="{{ Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}"
                                        value="{{ $item['due_date'] }}" required>
                                </td> --}}
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
                    <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <h2>No Items in Cart!</h2>
                </div>
            </div>
    @endif

    <script src="{{ asset('/js/checkout.js') }}" defer></script>
@endsection
