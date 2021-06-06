<?php

namespace App\Http\Controllers\Api;

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
use App\Models\Brands;
use App\Models\Languages;

class PollController extends Controller
{
    public function polls(Request $request) {
        $poll = new Polls();
        $poll->owner_id = $request->owner_id;
        $poll->branch_id = $request->branch_id;
        $poll->agent_id = $request->agent_id;
        $poll->score = $request->score;
        $poll->score_emp = $request->score_emp;
        $poll->score_ser = $request->score_ser;
        $poll->score_env = $request->score_env;
        $poll->score_non = $request->score_non;
        $poll->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function resend(Request $request) {
        $parent_id = Auth::user()->parent_id;

        $agent = Auth::user();
        $agent->sigPerMin += 1;
        $agent->save();

        $branch = Branchs::find(Auth::user()->branch);
        $company_info = CompanyInfo::where('owner_id', '=', $parent_id)->get();
        $current_template = Template::where('status', '=', 'ready')->where('owner_id', $parent_id)->first();
        
        $current_survey = Surveys::where('user_id', '=', $parent_id)->where('status', '=', 'ready')->where('branch_id', $agent->branch)->first();
        $questions = [];
        $langs_code = array();
        if($current_survey) {
            $questions = Questions::where('survey_id', '=', $current_survey->id)->get();
            $languages = $current_survey->languages;
            if(strrpos($languages, ':', 0)) {
                $lang_ids = explode(":", $current_survey->languages);
                foreach($lang_ids as $lang_id) {
                    $lang = Languages::find($lang_id);
                    array_push($langs_code, $lang->code);
                }
            }
            else {
                $lang_code = Languages::find($languages)->code;
                array_push($langs_code, $lang_code);
            }
        }
        
        $ratings = Rating::where('owner_id', '=', $parent_id)->get();
        $brands = Brands::where('owner_id', $parent_id)->get();
        return response()->json(['auth' => Auth::user(), 
            'branch_name' => $branch->name, 
            'company_info' => $company_info,
            'current_template' => $current_template,
            'current_survey' => $current_survey,
            'questions' => $questions,
            'ratings' => $ratings,
            'brands' => $brands,
            'languages' => $langs_code,
            'background_color' => env('APP_BACKGROUND_COLOR'),
            'header_color' => env('APP_HEADER_COLOR'),
            'footer_color' => env('APP_FOOTER_COLOR'),
        ], 200);
    }

    public function logo(Request $request) {
        $logo_url = env('APP_DEFAULT_LOGO');
        return response()->json(['logo' => $logo_url], 200);
    }
}
