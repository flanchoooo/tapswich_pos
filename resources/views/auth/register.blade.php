@extends('layouts.auth')

@section('content')
    <br>
    <br>
    <br>
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                @php
                                    $message = session('register');
                                    if(isset($message)){
                                    echo '<center><div><div  class="alert alert-danger" role="alert">'.$message.'</div></div></center>';
                                    }
                                @endphp

                                <a class="text-center" href="index.html"> <h4>{{env('SYS_NAME')}}</h4></a>

                                <form class="mt-5 mb-5 login-input" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="name" type="text"  placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <select id="name" type="text"  placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="instituation" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <option value="NMB">NMB</option>
                                        <option value="CBZ">CBZ</option>
                                        </select>
                                    </span>
                                    </div>

                                    <div class="form-group">
                                        <input id="email" type="email"  placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input id="password-confirm"  placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <button type="submit" class="btn login-form__btn submit w-100">Sign in</button>
                                </form>
                                <p class="mt-5 login-form__footer">
                                    <a class="btn btn-link" href="#">{{ __('') }}</a>
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
    </div>

@endsection
