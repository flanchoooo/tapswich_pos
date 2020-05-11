@extends('layouts.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Access Profile</h4>
                        <hr>
                        <a href="{{route('create_access_profile')}}"><label>Create Access Profile</label></a>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record => $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{\App\Permissions::find($values->user_type_id)->user_type_name}}</td>
                                            <td>{{$values->created_at}}</td>
                                            <td>
                                                <form role="form" action="{{route('edit_access_profile')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                    <div style="text-align: center;"><button type="submit" class="btn btn-outline-primary">   {{ __('View') }}</button></div>
                                                </form>
                                            </td>
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
@endsection
