<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

use App\Models\Polls;
use App\Models\User;
use App\Models\Branchs;
use App\Models\CompanyInfo;
use App\Models\Template;
use App\Models\Surveys;
use App\Models\Questions;
use App\Models\Rating;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->active != 1) {
            Auth::logout();
            return redirect()->route('login')
                ->with('message', 'You are not verified by admin. please wait until verification or call admin to ask it');
        }

        $current=time();
        $today = date("Y-m-d",$current);
        $branchs = [];
        $agents = [];
        $branch_filter = null;
        $user_filter = Auth::user()->id;
        $agent_filter = null;

        $branchs = Branchs::where('owner_id', Auth::user()->id)->get();

        if(Auth::user()->role == 3) {
            $branch_filter = Auth::user()->branch;
            $user_filter = Auth::user()->parent_id;
            $agents = User::where('branch', $branch_filter)->where('role', 4)->get();
        }
        
        //for today statistics
        $today_result = $this->get_today_result($today, $branch_filter, $user_filter, $agent_filter);
        
        //for weekly statistics
        $week_result = $this->get_weekly_result($today, $branch_filter, $user_filter, $agent_filter);
        
        //for monthly statistics
        $month_result = $this->get_month_result($today, $branch_filter, $user_filter, $agent_filter);
        
        //for cumulat months' statistics
        $cm_result = $this->get_cm_result($branch_filter, $user_filter, $agent_filter);
        
        //for this week branch scores 
        $branch_week_scores = $this->get_branch_scores($today, $user_filter, config('constants.FILTER_BY_WEEK'));
        //for this week branch scores 
        $branch_month_scores = $this->get_branch_scores($today, $user_filter, config('constants.FILTER_BY_MONTH'));
        
        // for current month top 3 teams statistics
        $start_date = date('Y-m-01', strtotime($today));
        $end_date = date('Y-m-t', strtotime($today));
        $top3team_current_month = $this->get_best3teams_result($start_date, $end_date);
        $top3emps_current_month = $this->get_best3employees_result($start_date, $end_date);
        
        //for top3 for last month
        $start_date_p = date('Y-m-d', strtotime(date('Y-m-01').' -1 MONTH'));
        $end_date_p = date('Y-m-d', strtotime(date('Y-m-t').' -1 MONTH'));
        $top3team_previous_month = $this->get_best3teams_result($start_date_p, $end_date_p);
        $top3emps_previous_month = $this->get_best3employees_result($start_date_p, $end_date_p);
        
        //for top3 for whole year
        $start_date_y = date('Y-m-d',strtotime(date('Y-01-01')));        
        $ts = strtotime($today);
        $tomorrow = (date('w', $ts) == 0) ? $ts : strtotime('tomorrow', $ts);
        $end_date_y = date('Y-m-d', $tomorrow);
        $top3team_from_year_start = $this->get_best3teams_result($start_date_y, $end_date_y);
        $top3emps_from_year_start = $this->get_best3employees_result($start_date_y, $end_date_y);

        //average score by question class
        $emp_score_agent = $this->get_result_by_class($branch_filter, $agent_filter, config('constants.QUESTION_CLASS_AGENT'));
        $ser_score_agent = $this->get_result_by_class($branch_filter, $agent_filter, config('constants.QUESTION_CLASS_SERVICE'));
        $env_score_agent = $this->get_result_by_class($branch_filter, $agent_filter, config('constants.QUESTION_CLASS_ENVIRONMENT'));
        
        //get_active_agents
        $active_users;
        if(!$branch_filter) {
            $active_users = User::where('parent_id', $user_filter)->where('connection', 'online')->where('role', 4)->get();
        }
        else {
            $active_users = User::where('parent_id', $user_filter)->where('branch', $branch_filter)->where('connection', 'online')->where('role', 4)->get();
        }
        $active_users_cnt = count($active_users);

        //get_last_months_result
        $last_12months_result = $this->get_last_months_result(12, $user_filter, $branch_filter, $agent_filter);
        $last_4months_result = $this->get_last_months_result(4, $user_filter, $branch_filter, $agent_filter);
        
        //get 3top and 3bottom employees
        $top3_employees = $this->get_top_bottom_3_employees($user_filter, $branch_filter, config('constants.IF_TOP_AGENTS'));
        $bottom3_employees = $this->get_top_bottom_3_employees($user_filter, $branch_filter, config('constants.IF_BOTTOM_AGENTS'));        
        return view("user.dashboard", [
            "branchs" => $branchs,
            "agents" => $agents,
            "today_result" => $today_result,
            "week_result" => $week_result,
            "month_result" => $month_result,
            "cm_result" => $cm_result,
            "top3team_current_month" => $top3team_current_month,
            "top3team_previous_month" => $top3team_previous_month,
            "top3team_from_year_start" => $top3team_from_year_start,
            "top3emps_current_month" => $top3emps_current_month,
            "top3emps_previous_month" => $top3emps_previous_month,
            "top3emps_from_year_start" => $top3emps_from_year_start,
            "emp_score_agent" => $emp_score_agent,
            "ser_score_agent" => $ser_score_agent,
            "env_score_agent" => $env_score_agent,
            "active_users_cnt" => $active_users_cnt,
            "last_12months_result" => $last_12months_result,
            "last_4months_result" => $last_4months_result,
            "top3_employees" => $top3_employees,
            "bottom3_employees" => $bottom3_employees,
            "branch_week_scores" => $branch_week_scores,
            "branch_month_scores" => $branch_month_scores,
        ]);
    }

    public function get_today_result($today, $branch, $user_id, $agent_id) {
        $result = [];
        if(!$branch) {
            $polls = Polls::where('owner_id', '=', $user_id)->where('created_at', 'like', $today."%")->get();
        }
        else {
            $polls = Polls::where('owner_id', '=', $user_id)->where('branch_id', '=', $branch)->where('created_at', 'like', $today."%")->get();
        }
        if($agent_id) {
            $polls = Polls::where('agent_id', $agent_id)->where('created_at', 'like', $today."%")->get();
        }
        $avg_score = 0;
        foreach($polls as $poll) {
            $avg_score += $poll->score;
        }
        $cnt = count($polls);
        if($cnt != 0) {
            $avg_score /= $cnt;
            $avg_score= number_format($avg_score, 1, '.', '');
        }
        $result[0] = $cnt;
        $result[1] = $avg_score;

        return $result;
    }

    public function get_weekly_result($today, $branch, $user_id, $agent_id) {
        $this->current_week_range($start_date, $end_date, $today);
        $result = [];
        if(!$branch) {
            $polls = Polls::where('owner_id', '=', $user_id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
        }
        else {
            $polls = Polls::where('owner_id', '=', $user_id)->where('branch_id', $branch)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
        }
        if($agent_id) {
            $polls = Polls::where('agent_id', $agent_id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
        }    
        $avg_score = 0;
        foreach($polls as $poll) {
            $avg_score += $poll->score;
        }
        $cnt = count($polls);
        if($cnt != 0) {
            $avg_score /= $cnt;
            $avg_score= number_format($avg_score, 1, '.', '');
        }
        $result[0] = $cnt;
        $result[1] = $avg_score;

        return $result;
    }

    public function get_branch_scores($today, $user_id, $week_or_month) {
        $this->current_week_range($start_date, $end_date, $today);
        if($week_or_month == config('constants.FILTER_BY_MONTH')) {
            $start_date = date('Y-m-01', strtotime($today));
            $end_date = date('Y-m-t', strtotime($today));
        }
        $branchs = Branchs::where('owner_id', $user_id)->get();
        $result = array();
        foreach($branchs as $branch) {
            $polls = Polls::where('owner_id', $user_id)->where('branch_id', $branch->id)->get();
            $team_result = array();
            $avg_score = 0;
            foreach($polls as $poll) {
                $avg_score += $poll->score;
            }
            $cnt = count($polls);
            if($cnt != 0) {
                $avg_score /= $cnt;
                $avg_score= number_format($avg_score, 1, '.', '');
            }
            $team_result = array("branch" => $branch->name, "score" => $avg_score);
            array_push($result, $team_result);
        }
        return $result;
    }

    public function get_month_result($today, $branch, $user_id, $agent_id) {
        $start_date = date('Y-m-01', strtotime($today));
        $end_date = date('Y-m-t', strtotime($today));
        $result = [];
        if(!$branch) {
            $polls = Polls::where('owner_id', '=', $user_id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
        }
        else {
            $polls = Polls::where('owner_id', '=', $user_id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->where('branch_id', '=', $branch)->get();
        }
        if($agent_id) {
            $polls = Polls::where('agent_id', $agent_id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
        }
        $avg_score = 0;
        foreach($polls as $poll) {
            $avg_score += $poll->score;
        }
        $cnt = count($polls);
        if($cnt != 0) {
            $avg_score /= $cnt;
            $avg_score= number_format($avg_score, 1, '.', '');
        }
        $result[0] = $cnt;
        $result[1] = $avg_score;

        return $result;
    }

    public function get_cm_result($branch, $user_id, $agent_id) {
        $result = [];
        if(!$branch) {
            $polls = Polls::where('owner_id', '=', $user_id)->get();
        }
        else {
            $polls = Polls::where('owner_id', $user_id)->where('branch_id', $branch)->get();
        }
        if($agent_id) {
            $polls = Polls::where('agent_id', $agent_id)->get();
        }
        $avg_score = 0;
        foreach($polls as $poll) {
            $avg_score += $poll->score;
        }
        $cnt = count($polls);
        if($cnt != 0) {
            $avg_score /= $cnt;
            $avg_score= number_format($avg_score, 1, '.', '');
        }
        $result[0] = $cnt;
        $result[1] = $avg_score;

        return $result;
    }

    public function current_week_range(&$start_date, &$end_date, $date) {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
        $start_date = date('Y-m-d', $start);
        $end_date = date('Y-m-d', strtotime('next saturday', $start));
    }

    public function get_best3teams_result($start_date, $end_date) {
        $result = array();
        $teams = Branchs::where('owner_id', Auth::user()->id)->get();
        $team_cnt = 0;
        foreach($teams as $team) {
            $team_result = array();
            $avg_score = 0;
            $polls =Polls::where('owner_id', Auth::user()->id)->where('branch_id', $team->id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
            foreach($polls as $poll) {
                $avg_score += $poll->score;
            }
            $cnt = count($polls);
            if($cnt != 0) {
                $avg_score /= $cnt;
                $avg_score = number_format($avg_score, 1, '.', '');
            }
            $team_result = array("name" => $team->name, "polls" => $cnt, "score" => $avg_score);
            $result[$team_cnt] = $team_result;
            $team_cnt++;
        }
        usort($result, function($a, $b) {
            if($a['score'] == $b['score'])  return 0;
            return ($a['score'] - $b['score']) > 0  ? -1 : 1;
        });
        $top3 = array_slice($result, 0, 3);
        return $top3;
    }

    public function get_best3employees_result($start_date, $end_date) {
        $result = array();
        $user = Auth::user();
        $owner_id = $user->id;
        
        if($user->role != 2) {
            $owner_id = $user->parent_id;
        }
        $agents;
        if($user->role != 2) {
            $agents = User::where('parent_id', $owner_id)->where('branch', $user->branch)->where('role', 4)->get();
        }
        else {
            $agents = User::where('parent_id', $owner_id)->where('role', 4)->get();
        }
        $agent_cnt = 0;
        foreach($agents as $agent) {
            $indiv_result = array();
            $avg_score = 0;
            $polls = Polls::where('owner_id', $owner_id)->where('agent_id', $agent->id)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
            foreach($polls as $poll) {
                $avg_score += $poll->score;
            }
            $cnt = count($polls);
            if($cnt != 0) {
                $avg_score /= $cnt;
                $avg_score = number_format($avg_score, 1, '.', '');
            }
            $indiv_result = array("name" => $agent->firstName.' '.$agent->lastName, "polls" => $cnt, "score" => $avg_score);
            $result[$agent_cnt] = $indiv_result;
            $agent_cnt++;
        }
        
        usort($result, function($a, $b) {
            if($a['score'] == $b['score'])  return 0;
            return ($a['score'] - $b['score']) > 0  ? -1 : 1;
        });
        $top3 = array_slice($result, 0, 3);
        return $top3;
    }

    public function get_result_by_class($branch, $agent, $class) {
        $result = 0;
        $owner_id = Auth::user()->id;
        $polls;
        if(!$branch) {
            $polls = Polls::where('owner_id', $owner_id)->get();
        }
        else {
            $owner_id = Branchs::find($branch)->owner_id;
            if(!$agent) {
                $polls = Polls::where('owner_id', $owner_id)->where('branch_id', $branch)->get();
            }
            else {
                $polls = Polls::where('owner_id', $owner_id)->where('branch_id', $branch)->where('agent_id', $agent)->get();
            } 
        }
        
        foreach($polls as $poll) {
            if($class == config('constants.QUESTION_CLASS_AGENT')) {
                $result += $poll->score_emp;
            }
            else if($class == config('constants.QUESTION_CLASS_SERVICE')) {
                $result += $poll->score_ser;
            }
            else if($class == config('constants.QUESTION_CLASS_ENVIRONMENT')) {
                $result += $poll->score_env;
            }
        }
        $cnt = count($polls);
        if($cnt != 0) {
            $result /= $cnt;
            $result = number_format($result, 1, '.', '');
        }
        return $result;
    }

    public function get_last_months_result($months, $owner, $branch, $agent) {
        $result = array();
        $time_line = array();
        for($i = $months; $i>0; $i--) {
            $polls_per_month;
            $start_date = date('Y-m-d', strtotime(date('Y-m-01').' -'.$i.' MONTH'));
            $end_date = date('Y-m-d', strtotime(date('Y-m-t').' -'.$i.' MONTH'));
            
            if(!$branch) {
                $polls_per_month = Polls::where('owner_id', $owner)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
            }
            else {
                if(!$agent) {
                    $polls_per_month = Polls::where('owner_id', $owner)->where('branch_id', $branch)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
                }
                else {
                    $polls_per_month = Polls::where('owner_id', $owner)->where('branch_id', $branch)->where('agent_id', $agent)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->get();
                }
            }
            $cnt = count($polls_per_month);
            $avg = 0;
            foreach($polls_per_month as $poll) {
                $avg += $poll->score;
            }
            if($cnt != 0) {
                $avg /= $cnt;
                $avg = number_format($avg, 1, '.', '');
            }
            $result_monthly = array("month" => 'last-'.$i.'-month', "polls" => $cnt, "score" => $avg);
            array_push($result, $result_monthly);
        }
        return $result;
    }

    public function get_top_bottom_3_employees($owner, $branch, $flag) {
        $result = array();
        $agents;
        if(!$branch) {
            $agents = User::where('parent_id', $owner)->where('role', 4)->get();
        }
        else {
            $agents = User::where('parent_id', $owner)->where('branch', $branch)->where('role', 4)->get();
        }
        $agent_cnt = 0;
        foreach($agents as $agent) {
            $indiv_result = array();
            $avg_score = 0;
            $polls = Polls::where('owner_id', $owner)->where('agent_id', $agent->id)->get();
            foreach($polls as $poll) {
                $avg_score += $poll->score;
            }
            $cnt = count($polls);
            if($cnt != 0) {
                $avg_score /= $cnt;
                $avg_score = number_format($avg_score, 1, '.', '');
            }
            $indiv_result = array("name" => $agent->firstName.' '.$agent->lastName, "polls" => $cnt, "score" => $avg_score);
            $result[$agent_cnt] = $indiv_result;
            $agent_cnt++;
        }
        if($flag == config('constants.IF_TOP_AGENTS')) {
            usort($result, function($a, $b) {
                if($a['score'] == $b['score'])  return 0;
                return ($a['score'] - $b['score']) > 0  ? -1 : 1;
            });
        }
        else {
            usort($result, function($a, $b) {
                if($a['score'] == $b['score'])  return 0;
                return ($a['score'] - $b['score']) > 0  ? 1 : -1;
            });
        }
        
        $result = array_slice($result, 0, 3);
        return $result;
    }

    public function get_info_by_filter(Request $request) {
        $current = time();
        $today = date("Y-m-d",$current);
        $branch_id = $request->branch_id;
        $user_id = Auth::user()->id;
        if(Auth::user()->role != 2) {
            $branch_id = Auth::user()->branch;
            $user_id = Auth::user()->parent_id;
        }
        $agent_id = $request->agent_id;
        $today_result = $this->get_today_result($today, $branch_id, $user_id, $agent_id);
        $week_result = $this->get_weekly_result($today, $branch_id, $user_id, $agent_id);
        $month_result = $this->get_month_result($today, $branch_id, $user_id, $agent_id);
        $cm_result = $this->get_cm_result($branch_id, $user_id, $agent_id);
        $emp_score = $this->get_result_by_class($branch_id, $agent_id, config('constants.QUESTION_CLASS_AGENT'));
        $ser_score = $this->get_result_by_class($branch_id, $agent_id, config('constants.QUESTION_CLASS_SERVICE'));
        $env_score = $this->get_result_by_class($branch_id, $agent_id, config('constants.QUESTION_CLASS_ENVIRONMENT'));
        $agents = User::where('parent_id', $user_id)->where('branch', $branch_id)->where('role',4)->get();
        $active_agents = User::where('parent_id', $user_id)->where('branch', $branch_id)->where('role',4)->where('connection', 'online')->get();
        if($agent_id) {
            if(User::find($agent_id)->connection == "online") {
                $active_agents_cnt = 1;
            }
            else {
                $active_agents_cnt = 0;
            }
        }
        $active_agents_cnt = count($active_agents);
        $last_12months_result = $this->get_last_months_result(12, $user_id, $branch_id, $agent_id);
        $last_4months_result = $this->get_last_months_result(4, $user_id, $branch_id, $agent_id);

        //get 3top and 3bottom employees
        $top3_employees = $this->get_top_bottom_3_employees($user_id, $branch_id, config('constants.IF_TOP_AGENTS'));
        $bottom3_employees = $this->get_top_bottom_3_employees($user_id, $branch_id, config('constants.IF_BOTTOM_AGENTS'));         

        return response()->json([
            'agents' => $agents,
            'today_result' => $today_result, 
            'week_result' => $week_result, 
            'month_result' => $month_result, 
            'cm_result' => $cm_result,
            'emp_score' => $emp_score,
            'ser_score' => $ser_score,
            'env_score' => $env_score,
            'active_agents' => $active_agents_cnt,
            'last_12months_result' => $last_12months_result,
            'last_4months_result' => $last_4months_result,
            'top3_employees' => $top3_employees,
            'bottom3_employees' => $bottom3_employees
        ], 200);
    }

    public function iamAlive(Request $request) {
        $user = Auth::user();
        if($user->role != 4) {
            $user->sigPerMin += 1;
            $user->save();
        }
        echo 'success';
    }

    public function refresh_data(Request $result) {
        $users = User::all();
        foreach($users as $user) {
            if($user->sigPerMin >= 2) {
                $user->connection = 'online';
                $user->sigPerMin = 0;
            }
            else {
                $user->connection = 'offline';
            }
            $user->save();
        }
        echo 'success';
    }
}
