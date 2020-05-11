@extends('layouts.auth')

@section('content')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">

                            <div class="card-body pt-5">
                                <a class="text-center" href="#"> <h4>{{env('SYS_NAME')}}</h4></a>


                                  <form  class="mt-5 mb-5 login-input" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                      @if (session('status'))
                                          <div class="alert alert-success" role="alert">
                                              {{ session('status') }}
                                          </div>
                                      @endif
                                    <div class="form-group">
                                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                                <p class="mt-5 login-form__footer">
                                    <a class="btn btn-link" href="{{ route('register') }}">{{ __('Dont have and account ?') }}</a>
                                    <a class="btn btn-link" href="{{ route('login') }}">{{ __('Login ?') }}</a>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
