@extends('layouts.auth')

@section('styles')            

@endsection

@section('content')
<div>
    <div class="logo">
        <span class="db"><img src="{{ asset('images/logo-icon.png') }}" alt="logo" /></span>
        <h5 class="font-medium m-b-20">Verify Your Email Address</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
          @if (session('resent'))
            <div class="alert alert-success" role="alert">
              {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
          @endif
          {{ __('Before proceeding, please check your email for a verification link.') }}
          {{ __('If you did not receive the email') }},
          <form class="form-horizontal m-t-20" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <div class="form-group text-center ">
                  <div class="col-xs-12 p-b-20 ">
                      <button href="dashboard-classic.html" class="btn btn-block btn-lg btn-info " type="submit ">{{ __('click here to request another') }}</button>
                  </div>
              </div>
          </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')            

@endsection
