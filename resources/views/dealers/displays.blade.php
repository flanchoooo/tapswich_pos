@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Transaction Report</h4>
                        <hr>
                        <div class="table-responsive">
                            <table id='example' class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th hidden>Before</th>
                                        <th hidden>After</th>
                                        <th>Status</th>
                                        <th>Acc</th>
                                        <th>Co.</th>
                                        <th>Date</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->narration}}</td>
                                            <td>{{$values->transaction_value}}</td>
                                            <td hidden>{{$values->balance_before}}</td>
                                            <td hidden>{{$values->balance_after}}</td>
                                            <td>{{$values->transaction_status}}</td>
                                            <td>{{$values->account}}</td>
                                            <td>@php
                                                $company = \App\Companies::find($values->company_id);
                                                echo $company["company_name"];
                                            @endphp</td>
                                            <td>{{$values->created_at}}</td>
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
