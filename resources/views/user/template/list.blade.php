@extends('layouts.user')

@section('styles')
<link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('content')

<!-- Alert with content -->
@if($message = Session::get('message'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">All Templates</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Template</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.template.create') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-plus"></i>Create New Template </a>
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
                <div class="card-body">
                    <div class="table-responsive m-t-20">
                        <table class="table table-bordered m-b-20" id="template_list" data-page-length='10'>
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Header Left</th>
                                    <th class="border-0">Header Center</th>
                                    <th class="border-0">Header Right</th>
                                    <th class="border-0">Footer Left</th>
                                    <th class="border-0">Footer Center</th>
                                    <th class="border-0">Footer Right</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $template->name }}</td>
                                    <td style="vertical-align: middle;">{{ mb_substr(strip_tags($template->description), 0, 40, 'utf-8') . '...' }}</td>
                                    <td style="vertical-align: middle;">{{ $template->header_left }}</td>
                                    <td style="vertical-align: middle;">{{ $template->header_center }}</td>
                                    <td style="vertical-align: middle;">{{ $template->header_right }}</td>
                                    <td style="vertical-align: middle;">{{ $template->footer_left }}</td>
                                    <td style="vertical-align: middle;">{{ $template->footer_center }}</td>
                                    <td style="vertical-align: middle;">{{ $template->footer_right }}</td>
                                    <td style="vertical-align: middle;">{{ $template->created_at }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="status_{{ $loop->index }}" onchange="change_status(this, {{ $template->id }})" name="status" {{ $template->status == 'ready'? 'checked': ''}}>
                                                <label class="custom-control-label" for="status_{{ $loop->index }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div class="popover-icon">
                                            <a class="btn btn-success btn-sm btn-circle" href="{{ route('user.template.edit', ['template_id' => $template->id ]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm btn-circle" href="javascript:void(0)" onclick="delete_template({{ $template->id }})"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<script>
    var base_url = "{{ url('/') }}";
</script>
<script src="{{ asset('js/pages/user/template.js') }}"></script>
@endsection