@extends('layouts.app')

@section('content')
{{-- {{dd($transactions)}} --}}
    <div class="container">
        <h1>Transaction History</h1>
        
        <a href="{{ route('transactions.download') }}" class="btn btn-primary">Download PDF</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Penalty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at }}</td>
                        <td>
                            @foreach($transaction->books as $transac)
                            {{ $transac->title }}
                            <br><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($transaction->books as $transac)
                            {{ $transac->pivot->quantity }}
                            <br><br>
                            @endforeach</td>
                        <td>${{ $transaction->penalty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
