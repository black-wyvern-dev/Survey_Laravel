@extends('layouts.user')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/chartist/dist/chartist.min.css') }}">
    <style type="text/css">
        .chart1  {
            stroke: #71A28A;
        }    
    </style>
    
@endsection

@section('content') 
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard Classic </h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="m-r-10">
                    <div class="lastmonth"></div>
                </div>
                <div class=""><small>LAST MONTH</small>
                    <h4 class="text-info m-b-0 font-medium">$58,256</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group m-b-30">
                <select class="select2 custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option value="">Select Agent</option>
                    @foreach($agents as $agent)
                    <option value="{{ $agent->id }}"> {{ $agent->firstName." ".$agent->lastName}}
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-5"></div>
        <div class="col-lg-4">
            <h3 class="card-title float-right">BRANCH TODAY : <span class="text-success"> {{ $today_result[1] }} </span></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h3 class="card-title">Today</h4>
                        </div>
                    </div>
                    <div class="row m-t-20 m-b-0">
                        <!-- column -->
                        <div class="col-sm-12 col-lg-6">
                            <div id="visitor" style="height:260px; width:100%;" class="m-t-20"></div>
                        </div>
                        <!-- column -->
                        <div class="col-sm-12 col-lg-6" style="padding-top: 50px">
                            <ul class="list-style-none" >
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-info font-12"></i> Open Ratio <span class="float-right">45%</span></li>
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-cyan font-12"></i> Clicked Ratio
                                    <span class="float-right">14%</span></li>
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-orange font-12"></i> Un-Open Ratio
                                    <span class="float-right">25%</span></li>
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-purple font-12"></i> Bounced Ratio
                                    <span class="float-right">17%</span></li>
                            </ul>
                        </div>
                        <!-- column -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <!-- Sales Summery -->
                    <div class="p-t-20">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="chart1" style="position: relative; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <!-- Sales Summery -->
                    <div class="p-t-20">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="chart2" style="position: relative; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-t-20">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <h4 class="card-title">3 TOP AGENTS</h4>
                    </div> 
                    <div class="table-responsive">
                        <table class="table v-middle">
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">POLLS</th>
                                <th class="border-top-0">AVERAGE SCORE</th>
                            </tr>
                            <tr>
                                <td><span class="text-success">$43567.98</span></td>
                                <td><span class="font-medium text-success">0.123</span></td>
                                <td><span class="text-success">$43567.98</span></td>
                            </tr>              
                            <tr>
                                <td><span class="text-info">$23135.78</span></td>
                                <td><span class="font-medium text-info">1.123</span></td>
                                <td><span class="text-info">$23135.78</span></td>
                            </tr>
                            <tr>
                                <td><span class="text-danger">$23135.78</span></td>
                                <td><span class="font-medium text-danger">1.123</span></td>
                                <td><span class="text-danger">$23135.78</span></td>
                            </tr>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <h4 class="card-title">3 AGENTS NEED IMPROVEMENT</h4>
                    </div> 
                    <div class="table-responsive">
                        <table class="table v-middle">
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">POLLS</th>
                                <th class="border-top-0">AVERAGE SCORE</th>
                            </tr>
                            <tr>
                                <td><span class="text-success">$43567.98</span></td>
                                <td><span class="font-medium text-success">0.123</span></td>
                                <td><span class="text-success">$43567.98</span></td>
                            </tr>              
                            <tr>
                                <td><span class="text-info">$23135.78</span></td>
                                <td><span class="font-medium text-info">1.123</span></td>
                                <td><span class="text-info">$23135.78</span></td>
                            </tr>
                            <tr>
                                <td><span class="text-danger">$23135.78</span></td>
                                <td><span class="font-medium text-danger">1.123</span></td>
                                <td><span class="text-danger">$23135.78</span></td>
                            </tr>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
<script src="{{ asset('js/pages/user/manager_dashboard.js') }}"></script>
@endsection