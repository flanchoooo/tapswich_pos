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
                                    <h1 class="h4 text-gray-900 mb-4">Create Dealer Profile</h1>
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

                                <form method="POST" action="/dealers/create">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="company_name" placeholder="Company Name" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control input-default" name="email" placeholder="Email" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="tel" class="form-control input-default" name="telephone" placeholder="Telephone" minlength="12" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="company_registration_number" placeholder="Registration Number" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default" name="external_reference" placeholder="Tax Clearance" required>
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
