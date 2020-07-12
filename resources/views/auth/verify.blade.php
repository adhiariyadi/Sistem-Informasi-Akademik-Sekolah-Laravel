@extends('layouts.app')
@section('page', 'Verify Your Email Address')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">A fresh verification link has been sent to your email address.</p>

  {{ __('Before proceeding, please check your email for a verification link.') }}
  {{ __('If you did not receive the email') }},
  <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
      @csrf
      <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
  </form>
</div>
@endsection
