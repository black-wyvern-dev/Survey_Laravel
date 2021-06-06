@extends('layouts.user')

@section('styles')
<style>
    .avatar_wrapper {
        position: relative;
    }

    .search_avatar_icon {
        position: absolute;
        top: 45%;
        left: 40px;
        color: #fff;
        opacity: 0;
    }

    .user_avatar {
        cursor: pointer;
        transition: 0.3s;
    }
    
    .user_avatar:hover {
        opacity: 0.5
    }

    .user_avatar:hover + .search_avatar_icon {
        opacity: 1;
    }
</style>
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Create New User</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.user.list') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-reply"></i>Go to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
            <div class="card">
                <form id="user_form" name="user_form" action="{{ route('user.user.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="file" id="photo" name="photo" style="display:none;" accept="image/*">
                                <div class="d-flex align-items-center avatar_wrapper" id="avatar_wrapper">
                                    <img src="{{ asset('images/users/5.jpg') }}" id="user_avatar" class="rounded-circle user_avatar" width="100" />
                                    <span class="search_avatar_icon"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="firstName" class="control-label col-form-label">First Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="First Name" id="firstName" name="firstName">
                                </div>
                                @error('firstName')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lastName" class="control-label col-form-label">Last Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Last Name" id="lastName" name="lastName">
                                    </div>
                                </div>
                                @error('lastName')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="control-label col-form-label">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="m-r-10 mdi mdi-email"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                                    </div>
                                </div>
                                @error('email')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="control-label col-form-label">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class=" fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                                    </div>
                                </div>
                                @error('password')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="control-label col-form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class=" fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="branch" class="control-label col-form-label">Branch</label>
                                    <select class="form-control" id="branch" name="branch">
                                        <option value="">All Branchs</option>
                                        @foreach($branchs as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('branch')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="control-label col-form-label">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option value="4">Agent</option>
                                        <option value="3">Branch Manager</option>
                                    </select>
                                </div>
                                @error('role')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="control-label col-form-label">Status</label>
                                    <div class="form-check">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="inactive_status" name="active" value="0" checked>
                                            <label class="custom-control-label" for="inactive_status">In Active</label>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="active_status" value="1" name="active">
                                            <label class="custom-control-label" for="active_status">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="action-form">
                                    <div class="form-group m-b-0 text-left">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                        <button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
@endsection

@section('scripts')


<script>
    var base_url = "{{ url('/') }}";
</script>
<script src="{{ asset('js/pages/user/user.js') }}"></script>
@endsection