@extends('layouts.app')
@section('page', 'Register Authentication')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">Register a new membership</p>

  <form action="{{ route('register') }}" method="post">
    @csrf
    <div class="input-group mb-3">
      <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">
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
    <div class="input-group mb-3">
      <select id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" autocomplete="role">
        <option value="">-- Select {{ __('Level User') }} --</option>
        <option value="Guru">Guru</option>
        <option value="Siswa">Siswa</option>
      </select>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-user-tag"></span>
        </div>
      </div>
      @error('role')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
      <div id="pesan"></div>
    </div>
    <div class="input-group" id="noId">
    </div>
    <div class="input-group mb-3">
      <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
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
    <div class="row mb-3">
      <div class="col-6">
        <a href="{{ route('login') }}" class="text-center btn btn-light text-blue">Login Saja</a>
      </div>
      <!-- /.col -->
      <div class="col-6 justify-content-end">
        <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }} &nbsp; <i class="nav-icon fas fa-sign-in-alt"></i></button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</div>
@endsection
