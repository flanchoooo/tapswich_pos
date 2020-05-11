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
                                    <h1 class="h4 text-gray-900 mb-4">Update Role Profile</h1>
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

                                <form method="POST" action="{{route('update_access')}}">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <input name="user_type_id" value="{{$records->id}}" hidden>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        @php
                                                            if($records->system_owner != 'on'){
                                                             echo '<input type="checkbox" name="system_owner" value="on">';
                                                                }else{
                                                            echo '<input type="checkbox" name="system_owner" value="on" checked>';
                                                                }
                                                        @endphp
                                                        <label>
                                                            {{ __('System Owner Access Rights') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        @php
                                                        if($records->dealer != 'on'){
                                                         echo '<input type="checkbox" name="dealer" value="on">';
                                                            }else{
                                                        echo '<input type="checkbox" name="dealer" value="on" checked>';
                                                            }
                                                        @endphp
                                                        <label>
                                                            {{ __('Dealer Access Rights') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        @php
                                                            if($records->employee != 'on'){
                                                             echo '<input type="checkbox" name="employee" value="on">';
                                                                }else{
                                                            echo '<input type="checkbox" name="employee" value="on" checked>';
                                                                }
                                                        @endphp
                                                        <label>
                                                            {{ __('Employee Access Rights') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        @php
                                                            if($records->authorization != 'on'){
                                                             echo '<input type="checkbox" name="authorization" value="on">';
                                                                }else{
                                                            echo '<input type="checkbox" name="authorization" value="on" checked>';
                                                                }
                                                        @endphp
                                                        <label>
                                                            {{ __('HR Access Rights') }}
                                                        </label>
                                                    </div>
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
