@extends('layouts.user')

@section('styles')
<link rel="stylesheet" href="{{ asset('libs/dropzone/dist/min/dropzone.min.css') }}" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
<style>
    .dropzone .dz-preview .dz-image {
        width: 120px;
        height: 120px;
    }

    .dropzone .dz-preview .dz-image img {
        height: 100%!important;
        width: 100%!important;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Brands</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brands</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Branding</h4>
                    <h6 class="card-subtitle">For multiple file upload For Brand  images.</h6>
                    <form id="dpz-remove-all-thumb" action="{{ route('user.brand.save') }}" method="POST" enctype="multipart/form-data" class="dropzone">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="file" multiple accept="image/*"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<script>
    var base_url = "{{ url('/') }}";
    var brands = <?php echo $brands ?>;
    console.log(brands);
</script>
<script src="{{ asset('js/pages/user/branding.js') }}"></script>
@endsection