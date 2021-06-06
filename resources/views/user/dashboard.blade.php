@extends('layouts.user')

@section('styles')

@endsection

@section('content') 
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard </h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="hhhhhh">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-b-30">
                <label class="mr-sm-2" for="branch_list">Select Branch</label>
                <select class="select2 custom-select mr-sm-2" id="branch_list">
                    <option value="">Choose Branch</option>
                    @foreach($branchs as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-b-30">
                <label class="mr-sm-2" for="agent_list">Select Agent</label>
                <select class="select2 custom-select mr-sm-2" id="agent_list">
                    <option selected>Choose Agent</option>
                    @if(Auth::user()->role != 2)
                    @foreach($agents as $agent)
                    <option value = "{{ $agent->id }}"> {{ $agent->firstName.' '.$agent->lastName}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card bg-pink bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center">TODAY</h3>
                    <h4 class="white-text m-b-0"><i class="fa fa-snowflake"></i>&nbsp;&nbsp;&nbsp;&nbsp;POLLS : <span id="today_result_cnt">{{ $today_result[0] }} </span></h4>
                    <h4 class="white-text m-b-0"><i class="fa fa-tags"></i>&nbsp;&nbsp;&nbsp;AVERAGE : <span id="today_result_avg">{{ $today_result[1] }} </span></h4>
                </div>
                <div class="m-t-20"></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-orange bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center">WEEK</h3>
                    <h4 class="white-text m-b-0"><i class="fa fa-snowflake"></i>&nbsp;&nbsp;&nbsp;&nbsp;POLLS : <span id="week_result_cnt"> {{ $week_result[0] }} </span></h4>
                    <h4 class="white-text m-b-0"><i class="fa fa-tags"></i>&nbsp;&nbsp;&nbsp;AVERAGE : <span id="week_result_avg">{{ $week_result[1] }} </span></h4>
                </div>
                <div class="m-t-20"></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-info bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center">MONTH</h3>
                    <h4 class="white-text m-b-0"><i class="fa fa-snowflake"></i>&nbsp;&nbsp;&nbsp;&nbsp;POLLS :<span id="month_result_cnt"> {{ $month_result[0] }} </span></h4>
                    <h4 class="white-text m-b-0"><i class="fa fa-tags"></i>&nbsp;&nbsp;&nbsp;AVERAGE : <span id="month_result_avg">{{ $month_result[1] }} </span></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-success bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center">POLLS CM</h3>
                    <h4 class="white-text m-b-0"><i class="fa fa-snowflake"></i>&nbsp;&nbsp;&nbsp;&nbsp;POLLS : <span id="cm_result_cnt">{{ $cm_result[0] }} </span></h4>
                    <h4 class="white-text m-b-0"><i class="fa fa-tags"></i>&nbsp;&nbsp;&nbsp;AVERAGE : <span id="cm_result_avg">{{ $cm_result[1] }} </span></h4>
                </div>
                <div class="m-t-20"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card bg-purple bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center"> Agent Score </h3>
                    <h1 class="white-text text-center m-b-0"><span id="emp_score"> {{ $emp_score_agent }} </span></h1>
                </div>
                <div class="m-t-20"></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-secondary bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center"> Service Score </h3>
                    <h1 class="white-text text-center m-b-0"><span id="ser_score"> {{ $ser_score_agent }} </span></h1>
                </div>
                <div class="m-t-20"></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-cyan bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center"> Environment Score </h3>
                    <h1 class="white-text text-center m-b-0"><span id="env_score"> {{ $env_score_agent }} </span></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-danger bg-gradient text-white  card-hover">
                <div class="card-body">
                    <h3 class="card-title text-center"> Active Agent </h3>
                    <h1 class="white-text text-center m-b-0"><span id="active_agents"> {{ $active_users_cnt }} </sapn></h1>
                </div>
                <div class="m-t-20"></div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    @if(Auth::user()->role != 4)
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h3 class="card-title text-center">This Week Scores per Branch</h4>
                        </div>
                    </div>
                    <div class="curwscores" style="position: relative; height:250px;"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h3 class="card-title text-center">This Month Scores per Branch</h4>
                        </div>
                    </div>
                    <div class="curmscores" style="position: relative; height:250px;"></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Polls & Scores</h4>
                            <h5 class="card-subtitle">Overview of Latest 12 Month</h5>
                        </div>
                    </div>
                    <!-- title -->
                    <div class="m-t-30">
                        <div id="12monthresult"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h3 class="card-title text-center">Polls per month (Last 4 month)</h4>
                        </div>
                    </div>
                    <div class="row m-t-20 m-b-0">
                        <!-- column -->
                        <div class="col-sm-12 col-lg-6">
                            <div id="last4polls" style="height:260px; width:100%;" class="m-t-20"></div>
                        </div>
                        <!-- column -->
                        <div class="col-sm-12 col-lg-6" style="padding-top: 50px">
                            <ul class="list-style-none" >
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-success font-12"></i> last 4th month 
                                    <span class="float-right" id="last_4th_month"> {{ $last_4months_result[0]['polls'] }} </span></li>
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-orange font-12"></i> last 3rd month
                                    <span class="float-right" id="last_3rd_month">{{ $last_4months_result[1]['polls'] }}</span></li>
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-info font-12"></i> last 2nd month
                                    <span class="float-right" id="last_2nd_month">{{ $last_4months_result[2]['polls'] }}</span></li>
                                <li class="m-t-20"><i class="fa fa-circle m-r-5 text-pink font-12"></i> previous month
                                    <span class="float-right" id="previous_month">{{ $last_4months_result[3]['polls'] }}</span></li>
                            </ul>
                        </div>
                        <!-- column -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h3 class="card-title text-center">Scores per month (Last 4 month)</h4>
                        </div>
                    </div>
                    <div class="last4scores" style="position: relative; height:250px;"></div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->role == 2)
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover">
                <div class="card-body">
                    <h4 class="card-title">MONTH TOP TEAMS</h4>
                    <ul class="list-group list-group-flush">
                        @for($i = 0; $i < count($top3team_current_month); $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $top3team_current_month[$i]['name'] }} <span class="badge badge-danger badge-pill"> {{ $top3team_current_month[$i]['polls'] }} </span><span class="badge badge-info badge-pill"> {{ $top3team_current_month[$i]['score']}} </span></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover">
                <div class="card-body">
                    <h4 class="card-title">PREV.MONTH</h4>
                    <ul class="list-group list-group-flush">
                        @for($i = 0; $i < count($top3team_previous_month); $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $top3team_previous_month[$i]['name'] }} <span class="badge badge-danger badge-pill"> {{ $top3team_previous_month[$i]['polls'] }} </span><span class="badge badge-info badge-pill"> {{ $top3team_previous_month[$i]['score']}} </span></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover">
                <div class="card-body">
                    <h4 class="card-title">YEAR TO DATE</h4>
                    <ul class="list-group list-group-flush">
                        @for($i = 0; $i < count($top3team_from_year_start); $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $top3team_from_year_start[$i]['name'] }} <span class="badge badge-danger badge-pill"> {{ $top3team_from_year_start[$i]['polls'] }} </span><span class="badge badge-info badge-pill"> {{ $top3team_from_year_start[$i]['score']}} </span></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover">
                <div class="card-body">
                    <h4 class="card-title">MONTH TOP INDIV</h4>
                    <ul class="list-group list-group-flush">
                        @for($i = 0; $i < count($top3emps_current_month); $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $top3emps_current_month[$i]['name'] }} <span class="badge badge-danger badge-pill"> {{ $top3emps_current_month[$i]['polls'] }} </span><span class="badge badge-info badge-pill"> {{ $top3emps_current_month[$i]['score']}} </span></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover">
                <div class="card-body">
                    <h4 class="card-title">PREV.MONTH</h4>
                    <ul class="list-group list-group-flush">
                        @for($i = 0; $i < count($top3emps_previous_month); $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $top3emps_previous_month[$i]['name'] }} <span class="badge badge-danger badge-pill"> {{ $top3emps_previous_month[$i]['polls'] }} </span><span class="badge badge-info badge-pill"> {{ $top3emps_previous_month[$i]['score']}} </span></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover">
                <div class="card-body">
                    <h4 class="card-title">YEAR TO DATE</h4>
                    <ul class="list-group list-group-flush">
                        @for($i = 0; $i < count($top3emps_from_year_start); $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $top3emps_from_year_start[$i]['name'] }} <span class="badge badge-danger badge-pill"> {{ $top3emps_from_year_start[$i]['polls'] }} </span><span class="badge badge-info badge-pill"> {{ $top3emps_from_year_start[$i]['score']}} </span></li>
                        @endfor
                    </ul>
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
                        <table class="table v-middle" id="top3_employess">
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">POLLS</th>
                                <th class="border-top-0">AVERAGE SCORE</th>
                            </tr>
                            @foreach($top3_employees as $employee)
                            <tr>
                                <td><span class="text-success"> {{ $employee['name'] }} </span></td>
                                <td><span class="font-medium text-success"> {{ $employee['polls'] }} </span></td>
                                <td><span class="text-success"> {{ $employee['score'] }} </span></td>
                            </tr>  
                            @endforeach            
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
                        <table class="table v-middle" id="bottom3_employees">
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">POLLS</th>
                                <th class="border-top-0">AVERAGE SCORE</th>
                            </tr>
                            @foreach($bottom3_employees as $employee)
                            <tr>
                                <td><span class="text-danger"> {{ $employee['name'] }} </span></td>
                                <td><span class="font-medium text-danger"> {{ $employee['polls'] }} </span></td>
                                <td><span class="text-danger"> {{ $employee['score'] }} </span></td>
                            </tr>  
                            @endforeach            
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var base_url = "{{ url('/') }}";
    var last_12m_data = '<?php echo json_encode($last_12months_result); ?>';
    var last_12m_data = JSON.parse(last_12m_data);
    var last_4m_data = '<?php echo json_encode($last_4months_result); ?>';
    var last_4m_data = JSON.parse(last_4m_data);
    var week_scores = '<?php echo json_encode($branch_week_scores); ?>';
    var week_scores = JSON.parse(week_scores);
    var month_scores = '<?php echo json_encode($branch_month_scores); ?>';
    var month_scores = JSON.parse(month_scores);
</script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('js/pages/user/dashboard.js') }}"></script>
@endsection