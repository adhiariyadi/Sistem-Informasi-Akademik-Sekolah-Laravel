@extends('layouts.app')
@section('page', 'Reset Password')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

  <form action="{{ route('reset.password.update', $user->id) }}" method="post">
    @csrf
    @method('patch')

    {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
    
    <div class="input-group mb-3">
      <input type="email" class="form-control" value="{{ $user->email }}" disabled>
      <div class="input-group-append" style="background-color: #E9ECEF">
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
    <div class="input-group mb-3">
      <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" autofocus>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="input-group mb-3">
      <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="row mb-2">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <div class="row">
    <div class="col-6">
      <a href="{{ route('login') }}" class="text-center btn btn-light text-blue">Login Saja</a>
    </div>
  </div>
</div>
@endsection
