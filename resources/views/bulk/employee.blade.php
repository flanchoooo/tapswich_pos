@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Owings</h4>
                        <hr>

                        @php
                            $message = session('upload_error');
                            if(isset($message)){

                            echo '<center><div><div  class="alert alert-danger" role="alert">'.$message.'</div></div></center>';

                            }
                        @endphp
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id='example' class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Account</th>
                                        <th>Amount Due</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record => $values)
                                        <tr>
                                            <td>@php

                                                $user = \App\User::whereMobile($values->account)->first();
                                                echo $user["name"];

                                            @endphp</td>
                                            <td>{{$values->account}}</td>
                                            <td>{{$values->total}}</td>
                                            <td>
                                                <form role="form" action="/bulk/settle" method="POST">
                                                    @csrf
                                                    <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->account}}"  name="account" >
                                                    <div style="text-align: center;"><button type="submit" class="btn btn-outline-primary">   {{ __('SETTLE') }}</button></div>
                                                </form>
                                            </td>
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
