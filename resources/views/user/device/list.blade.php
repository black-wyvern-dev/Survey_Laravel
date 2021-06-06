@extends('layouts.user')

@section('styles')
<link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">All Devices</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Device</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.device.create') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-plus"></i>Create New Device </a>
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
                        <table class="table table-bordered m-b-20" id="device_list" data-page-length='10'>
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Mac@ No</th>
                                    <th class="border-0">Branch</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                <tr>
                                    <td style="vertical-align: middle;">
                                        {{ $device->name }}
                                    </td>
                                    <td style="vertical-align: middle;">{{ $device->mac_num }}</td>
                                    <td style="vertical-align: middle;">
                                        {{ $device->get_branch($device->branch_id) }}
                                    </td>
                                    <td style="vertical-align: middle;">{{ $device->created_at }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="popover-icon">
                                            <a class="btn btn-success btn-circle" href="{{ route('user.device.edit', ['device_id' => $device->id ]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-circle" href="javascript:void(0)" onclick="delete_device({{ $device->id }})"><i class="fa fa-trash"></i></a>
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
<script src="{{ asset('js/pages/user/device.js') }}"></script>
@endsection