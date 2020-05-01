@extends('layouts.home')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-11 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Update Vehicle Profile</h1>
                                    <hr>
                                    @if ($flash = session('error'))
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

                                </div>

                                <form method="POST" action="/fleet/update">
                                    @csrf
                                    <div class="box-body">
                                        <input type="text" class="form-control input-default" name="id" value="{{$records->id}}" placeholder=Make required hidden>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="make" value="{{$records->make}}" placeholder=Make required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="model" value="{{$records->model}}" placeholder="Model" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="registration_number" value="{{$records->registration_number}}" placeholder="Registration Number" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="color" value="{{$records->color}}" placeholder="Colour" required>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                        <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
