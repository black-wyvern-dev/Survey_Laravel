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

    .branch_avatar {
        cursor: pointer;
        transition: 0.3s;
    }
    
    .branch_avatar:hover {
        opacity: 0.5
    }

    .branch_avatar:hover + .search_avatar_icon {
        opacity: 1;
    }
</style>
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Create New Branch</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Branch</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.branch.list') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-reply"></i>Go to List</a>
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
                <form id="branch_form" name="branch_form" action="{{ route('user.branch.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="file" id="picture" name="picture" style="display:none;" accept="image/*">
                                <div class="d-flex align-items-center avatar_wrapper" id="avatar_wrapper">
                                    <img src="{{ asset('images/gallery/1.jpg') }}" id="branch_avatar" class="branch_avatar" width="100" />
                                    <span class="search_avatar_icon"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="firstName" class="control-label col-form-label">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-list"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                                </div>
                                @error('name')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $name }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country" class="control-label col-form-label">Country</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-sitemap"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Country" id="country" name="country">
                                    </div>
                                </div>
                                @error('country')
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
                                    <label for="city" class="control-label col-form-label">City</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-warehouse"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="City" id="city" name="city">
                                    </div>
                                </div>
                                @error('city')
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
                                    <label for="manager_id" class="control-label col-form-label">Manager</label>
                                    <select class="form-control" id="manager_id" name="manager_id">
                                        <option value="">All Managers</option>
                                        @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->firstName.' '.$manager->lastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('manager_id')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
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
<script src="{{ asset('js/pages/user/branch.js') }}"></script>
@endsection