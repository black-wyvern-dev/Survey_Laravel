@extends('layouts.user')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Create New Template</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Template</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.template.list') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-reply"></i>Go to List</a>
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
                <form id="template_form" name="template_form" action="{{ route('user.template.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label col-form-label">Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="mdi mdi-stackexchange"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Template Name" id="name" name="name">
                                    </div>
                                </div>
                                @error('name')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label col-form-label">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                    </div>
                                </div>
                                @error('description')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_id" class="control-label col-form-label">Header Left</label>
                                    <select class="select2 form-control custom-select" name="header_left" style="width: 100%; height:36px;">
                                        <option value="None">None</option>
                                        <option value="Logo">Logo</option>
                                        <option value="Avatar&Name">Avatar&Name</option>
                                        <option value="Current Time">Current Time</option>
                                        <option value="Branch Name">Branch Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_id" class="control-label col-form-label">Header Center</label>
                                    <select class="select2 form-control custom-select" name="header_center" style="width: 100%; height:36px;">
                                        <option value="None">None</option>
                                        <option value="Logo">Logo</option>
                                        <option value="Avatar&Name">Avatar&Name</option>
                                        <option value="Current Time">Current Time</option>
                                        <option value="Branch Name">Branch Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_id" class="control-label col-form-label">Header Right</label>
                                    <select class="select2 form-control custom-select" name="header_right" style="width: 100%; height:36px;">
                                        <option value="None">None</option>
                                        <option value="Logo">Logo</option>
                                        <option value="Avatar&Name">Avatar&Name</option>
                                        <option value="Current Time">Current Time</option>
                                        <option value="Branch Name">Branch Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_id" class="control-label col-form-label">Footer Left</label>
                                    <select class="select2 form-control custom-select" name="footer_left" style="width: 100%; height:36px;">
                                        <option value="None">None</option>
                                        <option value="Logo">Logo</option>
                                        <option value="Avatar&Name">Avatar&Name</option>
                                        <option value="Current Time">Current Time</option>
                                        <option value="Branch Name">Branch Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_id" class="control-label col-form-label">Footer Center</label>
                                    <select class="select2 form-control custom-select" name="footer_center" style="width: 100%; height:36px;">
                                        <option value="None">None</option>
                                        <option value="Logo">Logo</option>
                                        <option value="Avatar&Name">Avatar&Name</option>
                                        <option value="Current Time">Current Time</option>
                                        <option value="Branch Name">Branch Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_id" class="control-label col-form-label">Footer Right</label>
                                    <select class="select2 form-control custom-select" name="footer_right" style="width: 100%; height:36px;">
                                        <option value="None">None</option>
                                        <option value="Logo">Logo</option>
                                        <option value="Avatar&Name">Avatar&Name</option>
                                        <option value="Current Time">Current Time</option>
                                        <option value="Branch Name">Branch Name</option>
                                    </select>
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
<script src="{{ asset('libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('libs/select2/dist/js/select2.min.js') }}"></script>

<script>
    var base_url = "{{ url('/') }}";
</script>
<script src="{{ asset('js/pages/user/template.js') }}"></script>
@endsection