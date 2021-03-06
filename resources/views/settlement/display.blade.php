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
                                                   // echo $cash_back = money_format('%i', $values->sumAmountByAcquirer/100);
                                                    echo $cash_back =  number_format((float)$values->sumAmountByAcquirer/100, 2, '.', '');
                                                @endphp</td>
                                            <td>@php
                                                   // echo $cash_back = money_format('%i', $values->sumAmountByIssuer /100);
                                                    echo $cash_back =  number_format((float)$values->sumAmountByIssuer/100, 2, '.', '');

                                                @endphp</td>
                                            <td>@php
                                                    //echo $cash_back = money_format('%i', $values->amount/100);
                                                    echo $cash_back =  number_format((float)$values->amount/100, 2, '.', '');
                                                @endphp</td>
                                            <td>{{$values->fee}}</td>
                                            <td>{{$values->settlementAmount /100}}</td>
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
