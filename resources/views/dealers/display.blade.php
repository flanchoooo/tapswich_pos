@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Dealer Registration</h4>
                        <hr>

                        @if ($flash = session('reg_notification'))
                            <div style="text-align: center;"/>
                            <div class="alert alert-danger" role="alert">
                                {{$flash}}
                            </div>
                        @endif

                        @if ($flash = session('success'))
                            <div  class="alert alert-success" role="alert">
                                {{$flash}}
                            </div>
                        @endif

                        <a href="{{route('create_dealers')}}"><label>Create Dealer</label></a>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id=example class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record => $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->company_name}}</td>
                                            <td>{{$values->created_at}}</td>
                                            <td>
                                                <form role="form" action="/company/edit" method="POST">
                                                    @csrf
                                                    <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                    <div style="text-align: center;"><button type="submit" class="btn btn-outline-primary">   {{ __('View') }}</button></div>
                                                </form>
                                            </td>
                                            <td>
                                                <form role="form" action="/employees/display" method="POST">
                                                    @csrf
                                                    <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                    <div style="text-align: center;"><button type="submit" class="btn btn-outline-primary">   {{ __('View Employees') }}</button></div>
                                                </form>
                                            </td>

                                            <td>
                                                <form role="form" action="{{route('new')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                    <div style="text-align: center;"><button type="submit" class="btn btn-outline-primary">   {{ __('Create Employee') }}</button></div>
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
