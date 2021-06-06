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
            <form class="form-horizontal m-t-20" action="{{ route('password.update') }}">
                <div class="form-group row">
                    <div class="col-12">
                        <input id="email" type="email" placeholder="Email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <div id="email_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input id="password" type="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('email')
                        <div id="email_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="password" required="" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
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