@extends('layouts.auth')

@section('styles')            

@endsection

@section('content')
<div>
    <div class="logo">
        <span class="db"><img src="{{ asset('images/logo-icon.png') }}" alt="logo" /></span>
        <h5 class="font-medium m-b-20">{{ __('Reset Password') }}</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif

          <form class="form-horizontal m-t-20" method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="form-group row">
                <div class="col-md-12">
                    <input id="email" type="email" placeholder="Email Address" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')            
<script>
  $('[data-toggle="tooltip"]').tooltip();
  $(".preloader").fadeOut();
</script>
@endsection
