@extends('layouts.home')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">

                                    <h1 class="h4 text-gray-900 mb-4">E-Value Position</h1>

                                    <hr>

                                </div>


                                <form method="POST" action="#">
                                    @csrf
                                    <div class="box-body">



                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Position:</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>{{  session('position')}}</label>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->

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
