@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search Results</h4>
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
                                        <th>ID</th>
                                        <th>Destination</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Narration</th>
                                        <th>Reference</th>
                                        <th>Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record => $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->mobile}}</td>
                                            <td>{{$values->amount}}</td>
                                            <td>{{$values->bulk_status}}</td>
                                            <td>{{$values->narration}}</td>
                                            <td>{{$values->bulk_reference}}</td>
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
