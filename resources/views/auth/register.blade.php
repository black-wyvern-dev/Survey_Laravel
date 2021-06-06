@extends('layouts.auth')

@section('styles')
    
@endsection
@section('content')
<div>
    <div class="logo">
        <span class="db"><img src="{{ asset('images/logo-icon.png') }}" alt="logo" /></span>
        <h5 class="font-medium m-b-20">Sign Up to Admin</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal m-t-20" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row ">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="text" required="" name="firstName" id="firstName" placeholder="First Name">
                        @error('firstName')
                            <div id="firstname_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="text" required="" name="lastName" id="lastName" placeholder="Last Name">
                        @error('lastName')
                            <div id="lastname_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
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
                        <input class="form-control form-control-lg" type="text" required="" name="email" id="email" placeholder="Email">
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
                        <input class="form-control form-control-lg" type="password" required="" name="password" id="password" placeholder="Password">
                        @error('password')
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
                <div class="form-group row">
                    <div class="col-md-12 ">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center ">
                    <div class="col-xs-12 p-b-20 ">
                        <button href="dashboard-classic.html" class="btn btn-block btn-lg btn-info " type="submit ">SIGN UP</button>
                    </div>
                </div>
                <div class="form-group m-b-0 m-t-10 ">
                    <div class="col-sm-12 text-center ">
                        Already have an account? <a href="{{ route('login') }}" class="text-info m-l-5 "><b>Sign In</b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')            
<script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();

    $("#firstName").on('focus', function() {
        if($("#firstname_alert")) {
            $("#firstname_alert").remove();
        }
    })

    $("#lastName").on('focus', function() {
        if($("#lastname_alert")) {
            $("#lastname_alert").remove();
        }
    })

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
