@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Authorizations</h4>
                        <hr>

                        @php
                            $message = session('upload_error');
                            if(isset($message)){

                            echo '<center><div><div  class="alert alert-danger" role="alert">'.$message.'</div></div></center>';

                            }
                        @endphp
                        <a href="{{route('upload_file')}}"><label>Upload File</label></a>
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
                                        <th></th>
                                        <th></th>


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
                                            <td>
                                                <form role="form" action="/bulk/decline" method="POST">
                                                    @csrf
                                                    <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                    <div style="text-align: center;"><button type="submit" class="btn btn-outline-primary">   {{ __('DECLINE') }}</button></div>
                                                </form>
                                            </td>

                                            <td>
                                                <form role="form" action="/bulk/authorize" method="POST">
                                                    @csrf
                                                    <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                    <div style="text-align: center;"><button type="submit" class="btn btn-outline-primary">   {{ __('AUTHORIZE') }}</button></div>
                                                </form>
                                            </td>
                                        </tr>
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
