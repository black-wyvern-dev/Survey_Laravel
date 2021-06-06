<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Branchs;
use App\Models\CompanyInfo;
use App\Models\Template;
use App\Models\Surveys;
use App\Models\Questions;
use App\Models\Rating;
use App\Models\Brands;
use App\Models\Languages;

class AuthenticationController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken('TutsForWeb')->accessToken;
        return response()->json(['token' => $token], 200);
    }
    /**
    * Handles Login Request
    *
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            
            $user = Auth::user();
            $user->connection = 'online';
            $user->save();
            $parent_id = Auth::user()->parent_id;
            if(Auth::user()->role != 4) {
                return response()->json(['message' => 'You are not a agent, agent can only do survey!'], 401);
            }
            $branch = Branchs::find(Auth::user()->branch);
            $company_info = CompanyInfo::where('owner_id', '=', $parent_id)->get();
            $current_template = Template::where('status', '=', 'ready')->where('owner_id', $parent_id)->first();
            $current_survey = Surveys::where('user_id', '=', $parent_id)->where('branch_id', $user->branch)->where('status', '=', 'ready')->first();
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
            if(!$current_survey || !$ratings) {
                return response()->json(['token' => $token, 'auth' => Auth::user(), 'branch_name' => $branch->name, 'message' => 'Survey not defined yet'], 200);
            }
            return response()->json(['token' => $token, 
            'auth' => Auth::user(),
            'branch_name' => $branch->name, 
            'company_info' => $company_info, 
            'current_template' => $current_template, 
            'current_survey' => $current_survey, 
            'questions' => $questions, 
            'ratings' => $ratings,
            'brands' => $brands,
            'languages' => $langs_code,
            'background_color' => '#'.env('APP_BACKGROUND_COLOR'),
            'header_color' => '#'.env('APP_HEADER_COLOR'),
            'footer_color' => '#'.env('APP_FOOTER_COLOR'),
        ], 200);
        } 
        else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
       
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json(['message' => 'You have been successfully logged out!'], 200);
    }
}
