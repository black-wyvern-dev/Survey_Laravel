@extends('layouts.auth')

@section('styles')            

@endsection

@section('content')
<div>
    <div class="logo">
        <span class="db"><img src="{{ asset('images/logo-icon.png') }}" alt="logo" /></span>
        <h5 class="font-medium m-b-20">{{ __('Confirm Password') }}</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
          {{ __('Please confirm your password before continuing.') }}
          <form class="form-horizontal m-t-20" method="POST" action="{{ route('password.confirm') }}">
              @csrf
              <div class="form-group row">
                
                <div class="col-md-12">
                  <input id="password" type="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                  @error('password')
                  <div id="password_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-xs-12 p-b-20">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Confirm Password') }}
                  </button>
                </div>
                
                @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                  </a>
                @endif
              </div>
          </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')            

@endsection
