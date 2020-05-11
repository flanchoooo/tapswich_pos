@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Acquired Transaction Report</h4>
                        <hr>
                        <div class="table-responsive">
                            <table id='example' class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Issuer</th>
                                        <th>Acquirer</th>
                                        <th>TID</th>
                                        <th hidden>POS Type</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>PAN</th>
                                        <th hidden>Switch Fee</th>
                                        <th hidden>AcquirerFee</th>
                                        <th hidden>Issuer Fee</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->issuer}}</td>
                                            <td>{{$values->acquirer}}</td>
                                            <td>{{$values->terminalId}}</td>
                                            <td hidden>{{$values->posType}}</td>
                                            <td>
                                                @php
                                                  echo substr($values->transactionDate,10,18)
                                                @endphp
                                            </td>
                                            <td>{{$values->transactionType}}</td>
                                            <td>{{$values->cardPan}}</td>
                                            <td hidden>{{$values->switchFee}}</td>
                                            <td hidden>{{$values->acquirerFee}}</td>
                                            <td hidden>{{$values->issuerFee}}</td>
                                            <td>{{$values->amount}}</td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection