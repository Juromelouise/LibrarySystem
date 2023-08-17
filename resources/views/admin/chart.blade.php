@extends('layout.master')
@section('title')
    New York Sanctuary
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center title">
        <h1>Charts</h1>
    </div>
    <div>
        <div>
            <canvas id="myChart"></canvas>
        </div>
        <div class="row">
            <div class="col-md-6">
                <canvas id="myChart1"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('/js/chart.js') }}"></script>
@endsection
