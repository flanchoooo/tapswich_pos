@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Net Settlement Transaction Report</h4>
                        <hr>
                        <div class="table-responsive">
                            <table id='example' class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th hidden>Acquirer ID</th>
                                        <th hidden>Issuer ID</th>
                                        <th>Sum By Acquirer</th>
                                        <th>Sum By Issuer</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                        <th>Settlement Amount</th>
                                        <th>Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->datetime}}</td>
                                            <td hidden>{{$values->acquirerId}}</td>
                                            <td hidden>{{$values->issuerId}}</td>
                                            <td>@php
                                                    echo $cash_back = money_format('%i', $values->sumAmountByAcquirer);
                                                @endphp</td>
                                            <td>@php
                                                    echo $cash_back = money_format('%i', $values->sumAmountByIssuer);
                                                @endphp</td>
                                            <td>@php
                                                    echo $cash_back = money_format('%i', $values->amount/100);
                                                @endphp</td>
                                            <td>{{$values->fee}}</td>
                                            <td>{{$values->settlementAmount}}</td>
                                            <td>{{$values->description}}</td>
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
