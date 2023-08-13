@extends('layout.master')
@section('title')
    New York Sanctuary
@endsection

@section('content')
    <div class="container">
        <div>
            <canvas id="myChart"></canvas>
        </div>
        <div>
            <canvas id="myChart1"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('/js/chart.js') }}"></script>
@endsection
