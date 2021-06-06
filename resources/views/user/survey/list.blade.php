@extends('layouts.user')

@section('styles')
<link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('content')

@if (Session::has('error'))
    <input type="hidden" class="error-message" value="{{ Session::get('error') }}">
    @php
        Session::forget('error');
    @endphp
@endif

@if (Session::has('success'))
    <input type="hidden" class="success-message" value="{{ Session::get('success') }}">
    @php
        Session::forget('success');
    @endphp
@endif

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-2 align-self-center">
            <h4 class="page-title">All Surveys</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Survey</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="branch" class="control-label col-form-label">Select Branch</label>
                <select class="form-control" id="branch" name="branch">
                    <option value="">All Branchs</option>
                    @foreach($branchs as $branch)
                        <option value="{{ $branch->id }}"
                            {{$cur_branch == $branch->id ? 'selected' : ''}}
                        >{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-8 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('user.survey.create') }}" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-plus"></i>Create New Survey </a>
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
                        <table class="table table-bordered m-b-20" id="survey_list" data-page-length='10'>
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Title</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Branch</th>
                                    <th class="border-0">languages</th>
                                    <th class="border-0">Active/InActive</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surveys as $survey)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $survey->name }}</td>
                                    <td style="vertical-align: middle;">{{ $survey->description }}</td>
                                    <td style="vertical-align: middle;">{{ $survey->getBranch->name }}</td>
                                    <td style="vertical-align: middle;">{{ $survey->getLanguages($survey->languages) }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" multiple="multiple" class="custom-control-input" id="status_{{ $loop->index }}" onclick="change_status(this, {{ $survey->id }})" name="status" {{ $survey->status == 'ready'? 'checked': ''}}>
                                                <label class="custom-control-label" for="status_{{ $loop->index }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;">{{ $survey->created_at }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="popover-icon">
                                            <a class="btn btn-success btn-circle" href="{{ route('user.survey.edit', ['survey_id' => $survey->id ]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-circle" href="javascript:void(0)" onclick="delete_survey({{ $survey->id }})"><i class="fa fa-trash"></i></a>
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

        <form
            id = "branchForm"
            action = "{{route('user.survey.list')}}"
            method = "get"
        >
            @csrf
            <input name= "branch" id = "branchId" style = "display:none"/>
        </form>
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
<script src="{{ asset('js/pages/user/survey.js') }}"></script>
@endsection