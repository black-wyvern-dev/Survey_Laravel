@extends('layouts.auth')

@section('styles')
    
@endsection

@section('content')
<div id="loginform">
    <div class="logo">
        <span class="db"><img src="{{ asset('images/logo-icon.png') }}" alt="logo" /></span>
        <h5 class="font-medium m-b-20">Sign In to Admin</h5>
    </div>
    <!-- Form -->
    <div class="row">
    @if(session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session()->get('message') }}
        </div>
    @endif
        <div class="col-12">
            <form class="form-horizontal m-t-20" id="loginform" method="post" action="{{route('login')}}">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ti-user"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" placeholder="Email" id="email" name="email">
                </div>
                @error('email')
                <div id="email_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
                @enderror
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Password" id="password" name="password">
                </div>
                @error('password')
                <div id="password_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
                @enderror
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Remember me</label>
                            <a href="{{ route('password.request') }}" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button href="dashboard-classic.html" class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social">
                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fab  fa-facebook"></i> </a>
                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fab  fa-google-plus"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0 m-t-10">
                    <div class="col-sm-12 text-center">
                        Don't have an account? <a href="{{route('register')}}" class="text-info m-l-5"><b>Sign Up</b></a>
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

    $("#email").on('focus', function() {
        if($("#email_alert")) {
            $("#email_alert").remove();
        }
        })

    $("#password").on('focus', function() {
        if($("#password_alert")) {
            $("#password_alert").remove();
        }
    })
</script>
@endsection
            