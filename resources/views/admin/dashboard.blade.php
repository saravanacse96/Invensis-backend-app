@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}</p>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="row">
                        <h3>Pages</h3>
                     <div class="col-md-8">
                        <table class="table" border="1" style="border: 0.5px solid #cccccc;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->type == 'Normal Page' ? $page->title : $page->product}}</td>
                                    @if($page->type == 'Normal Page')
                                        <td style="color:rgb(54, 162, 235)">{{ $page->type }}</td>
                                    @else
                                        <td style="color:rgb(255, 99, 132)">{{ $page->type }}</td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-4">
                            <div style="width: 75%; margin: auto;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h3>Payment History</h3>
                     <div class="col-md-10" style="margin-left:5rem">
                        <table class="table" border="1" style="border: 0.5px solid #cccccc;">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->description}}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->currency }}</td>
                                    <td style="color:green">{{ $payment->status }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">

        const ctx = document.getElementById('myChart').getContext('2d');
        const data = {
            labels: [
                'Payment',
                'Normal',
            ],
            datasets: [{
                label: 'Count',
                data: ['{{ $payment_val }}','{{ $normal_val }}'],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)'
                ],
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'doughnut',
            data: data,
        };

        const myChart = new Chart(ctx, config);

    </script>
@endsection
