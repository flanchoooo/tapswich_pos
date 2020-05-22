@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Merchant Transactions Report</h4>
                        <hr>
                        <div class="table-responsive">
                            <table id='example' class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>Acquirer</th>
                                        <th>Merchant</th>
                                        <th>Merchant ID</th>
                                        <th>Transaction Count</th>
                                        <th>Total</th>
                                        <th>Acquirer Fee</th>
                                        <th>Issuer Fee</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $values)
                                        <tr>
                                            <td>{{$values->acquirerName}}</td>
                                            <td>{{$values->merchant}}</td>
                                            <td>{{$values->merchantId}}</td>
                                            <td>{{$values-> transactionCount}}</td>
                                            <td>{{ number_format((float)$values->total/100, 2, '.', '')}}</td>
                                            <td>{{ number_format((float)$values->acquirerFees/100, 2, '.', '')}}</td>
                                            <td>{{ number_format((float)$values->issuerFees/100, 2, '.', '')}}</td>
                                    @endforeach
                                    </tbody>Mer
                                </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
