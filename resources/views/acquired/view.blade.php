@extends('layouts.home')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-11">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Search Acquired Transaction</h1>
                                    @php
                                        $message = session('acq_message');
                                        if(isset($message)){

                                        echo '<center><div><div  class="alert alert-danger" role="alert">'.$message.'</div></div></center>';

                                        }
                                    @endphp

                                    <hr>
                                </div>

                                <div class="container">

                                    <form method="POST" action="/acquired/display">
                                        @csrf
                                        <div class="form-group row justify-content-center ">
                                            <div class="col-sm-4">
                                                <label for="exampleInputEmail1">Start Date</label>
                                                <input id="mobile" type="date" class="form-control datepicker" name="start_date" value="" required autofocus>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="exampleInputEmail1">End Date</label>
                                                <input id="mobile" type="date" class="form-control datepicker" name="end_date" value="" required autofocus>
                                            </div>

                                            <div class="col-sm-2" style="margin-top: 30px">
                                                <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </form>
                                </div>





                                <br>
                                <div class="box-body">
                                    <!-- /.table-responsive -->



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
