@extends('layouts.user')

@section('styles')
<link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">All Social Links</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Company Information</li>
                    </ol>
                </nav>
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
                        <table class="table table-bordered m-b-20" id="social_list" data-page-length='10'>
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Link</th>
                                    <th class="border-0">Social</th>
                                    <th class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($infors as $info)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $info->name }}</td>
                                    <td style="vertical-align: middle;">
                                        {{ $info->url }}
                                    </td>
                                    <td style="vertical-align: middle;">{{ $info->category_id }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="popover-icon">
                                            <a class="btn btn-success btn-circle" href="javascript:void(0)" onclick="edit_url({{ $info->id }}, '{{ $info->url }}')"><i class="fa fa-edit"></i></a>
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
<div class="modal fade" id="social_modal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="social_form" name="social_form" method="POST" action="{{ route('user.companyinfo.update') }}">
                @csrf
                <input type="hidden" id="company_info_id" name="company_info_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Edit Social Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter Link" id="url" name="url" value="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="ti-save"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<script>
    var base_url = "{{ url('/') }}";

    function edit_url(id, url) {
        $("#company_info_id").val(id);
        $("#url").val(url);

        $("#social_modal").modal();
    }

    $('#social_list').DataTable({
            "columnDefs": [
                { "searchable": false, "targets": 2 }
            ],
            "createdRow": function(row, data, index) {
                if (data[2] == 1) {
                    $('td', row).eq(2).html('<span><i class="fab fa-facebook"></i></span> FaceBook');
                }
                else if(data[2] == 2) {
                    $('td', row).eq(2).html('<span><i class="fab fa-instagram"></i></span> Instagram');
                }
                else if(data[2] == 3) {
                    $('td', row).eq(2).html('<span><i class="fab fa-twitter"></i></span> Twitter');
                }
                else if(data[2] == 4) {
                    $('td', row).eq(2).html('<span><i class="fab fa-linkedin"></i></span> LinkedIn');
                }
            }
        });
</script>
@endsection