@extends('layouts.user')

@section('styles')
<style>
    
    .smile_wrapper {
        position: relative;
    }

    .search_avatar_icon {
        position: absolute;
        top: 45%;
        left: 40px;
        color: #fff;
        opacity: 0;
    }

    .smile_photo {
        cursor: pointer;
        transition: 0.3s;
    }
    
    .smile_photo:hover {
        opacity: 0.5
    }

    .smile_photo:hover + .search_avatar_icon {
        opacity: 1;
    }

</style>
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Rating</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Rating</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.rating.list') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-reply"></i>Go to List</a>
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
                <form id="rating_form" name="rating_form" action="{{ route('user.rating.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" id="rating_id" name="rating_id" value="{{ $rating->id }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label col-form-label">Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-images"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ $rating->name }}">
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
                                    <label for="score" class="control-label col-form-label">Score</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Score" id="score" name="score" min="0" step="0.1" value="{{ $rating->score }}">
                                    </div>
                                </div>
                                @error('score')
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
                                    <label class="control-label col-form-label">Smile</label>
                                    <input type="file" id="url" name="url" style="display:none;" accept="image/*">
                                    <div class="d-flex align-items-center smile_wrapper" id="smile_wrapper">
                                        @if($rating->content == '')
                                            <img src="{{ asset('images/smiles.png') }}" id="smile_photo" class="rounded-circle smile_photo" width="100" height="100" style="background-color: #fff; "/>
                                        @else
                                            <img src="{{ asset('storage/' . $rating->content) }}" id="smile_photo" class="rounded-circle smile_photo" width="100" height="100"/>
                                        @endif
                                        <span class="search_avatar_icon"><i class="fa fa-search"></i></span>
                                    </div>
                                    @error('url')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                    @enderror
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
<script src="{{ asset('js/pages/user/rating.js') }}"></script>
@endsection