@extends('layouts.app')
@section('title','Log In')
@section('content')
<div id="login_bg">
    <div class="dark-overlay">                
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="container-form text-white">
                <div class="card-body py-0 mb-3 border-bottom">
                    <h2 class="text-center">Log-In</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>    
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif                    
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>            
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-check">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                    <button type="submit" class="btn btn--info btn-block">
                            Login
                        </button>

                        <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                        <a class="btn btn-outline-primary btn-sm text-white" href="{{ route('register') }}">
                            Register a New Account
                        </a>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
