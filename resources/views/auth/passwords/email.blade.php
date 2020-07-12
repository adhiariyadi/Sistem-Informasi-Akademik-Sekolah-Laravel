@extends('layouts.app')
@section('page', 'Reset Password')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

  <form action="{{ route('cek-email') }}" method="post">
    @csrf
    <div class="input-group mb-3">
      <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
      @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="row mb-3">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
      </div>
      <!-- /.col -->
    </div>
    
    <div class="row">
      <div class="col-6">
        <a href="{{ route('login') }}" class="text-center btn-block btn btn-light text-blue">Login Saja</a>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <a href="{{ route('register') }}" class="text-center btn-block btn btn-light text-blue">Buat Akun</a>
      </div>
      <!-- /.col -->
    </div>
  </form>
</div>
@endsection
