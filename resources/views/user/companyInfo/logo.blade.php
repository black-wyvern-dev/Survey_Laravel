@extends('layouts.user')

@section('styles')
<style>
    .avatar_wrapper {
        position: relative;
        
    }

    .search_avatar_icon {
        position: absolute;
        top: 45%;
        left: 340px;
        color: #fff;
        font-size: 30px;
        opacity: 0;
    }

    .logo {
        cursor: pointer;
        transition: 0.3s;
    }
    
    .logo:hover {
        opacity: 0.5
    }

    .logo:hover + .search_avatar_icon {
        opacity: 1;
    }
</style>
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Company Logo</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Company Logo</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.companyinfo.list') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-reply"></i>Go to Social Links</a>
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
                <form id="logo_form" name="logo_form" action="{{ route('user.companyinfo.updateLogo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <input type="file" id="url" name="url" style="display:none;" accept="image/*">
                                <div class="d-flex align-items-center avatar_wrapper" id="avatar_wrapper">
                                    @if($logo->url == '')
                                    <img src="{{ asset('images/gallery/1.jpg') }}" id="logo" class="logo" width="700" />
                                    @else
                                    <img src="{{ asset('storage/' . $logo->url) }}" id="logo" class="logo" width="700" />
                                    @endif
                                    <span class="search_avatar_icon"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4  d-flex align-items-center justify-content-center">
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
<script src="{{ asset('js/pages/user/companyinfo.js') }}"></script>
@endsection