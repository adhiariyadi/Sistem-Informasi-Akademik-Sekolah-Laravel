@extends('layouts.app')
@section('page', 'Confirm Password')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">Please confirm your password before continuing.</p>

  <form action="{{ route('password.confirm') }}" method="post">
    @csrf
    <div class="input-group mb-3">
      <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
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
    <div class="row mb-1">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm Password') }}</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <div class="row">
    <div class="col-12">
      <p class="mb-1 text-center">
        @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
        @endif
      </p>
    </div>
  </div>
</div>
@endsection
