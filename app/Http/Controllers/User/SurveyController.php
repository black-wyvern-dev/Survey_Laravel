<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use  Auth;

use App\Models\Surveys;
use App\Models\Questions;
use App\Models\Languages;
use App\Models\Rating;
use App\Models\RatingCat;
use App\Models\Branchs;

class SurveyController extends Controller
{
    public function list(Request $request) {
        $branch = $request->branch;
        $branchs = Branchs::where('owner_id', Auth::user()->id)->get();
        if ($branch) {
            $surveys = Surveys::where('user_id', Auth::user()->id)->where('branch_id', $branch)->orderByDesc('created_at')->get();
            $cur_branch = $branch;
        } else {
            $surveys = Surveys::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
            $cur_branch = null;
        }
        return view('user.survey.list', compact('surveys', 'branchs', 'cur_branch'));
    }
    
    public function create()
    {
        $languages = Languages::all();
        $ratingcats = RatingCat::all();
        $branches = Branchs::where('owner_id', Auth::user()->id)->get();
        $ratings = Rating::where('category_id', 1)->where('owner_id', Auth::user()->id)->get();
        return view('user.survey.create', compact('languages', 'ratingcats', 'ratings', 'branches'));
    }
    
    public function save(Request $request)
    {
        $rule = [
            'name' => 'required',
            'branch' => 'required',
            'description' => 'required',
            'languages.*' => 'required',
            'question_description.*' => 'required',
            'question_class.*' => 'required',
            'question_cat.*' => 'required',
            'answer_content' => 'required',
            'answer_content.*.*' => 'required',
        ];

        $customMessages = [
            'languages.*.required' => 'Languages did not be entered exactly, please check it agian',
            'question_description.*.required' => 'Question Description did not be entered exactly, please check it agian',
            'question_class.*.required' => 'Question class did not be entered exactly, please check it again',
            'question_cat.*.required' => 'Rating Category did not be entered exactly, please check it agian',
            'answer_content.*.*.required' => 'Answer did not be entered exactly, please check it agian',
        ];

        $this->validate($request, $rule, $customMessages);

        $languages = $request->languages;
        $lang_text = '';
        for($i=0; $i<count($languages); $i++) {
            if($i==0) {
                $lang_text .= $languages[$i];
            }
            else {
                $lang_text .= ':' . $languages[$i];
            }
        }

        $survey = new Surveys();
        $survey->user_id = Auth::user()->id;
        $survey->branch_id = $request->branch;
        $survey->name = $request->name;
        $survey->description = $request->description;
        $survey->languages = $lang_text;
        $survey->status = 'draft';

        $survey->save();

        for($i=0; $i<count($request->question_description); $i++) {
            $question = new Questions;
            
            $question->survey_id = $survey->id;
            $question->description = $request->question_description[$i];
            $question->class = $request->question_class[$i];
            $question->rating_cat_id = $request->question_cat[$i];

            if($question->rating_cat_id == 1) {
                $answer = '';
                for($j=0; $j<count($request->answer_content[$i]); $j++) {
                    if($j == 0) {
                        $answer .= $request->answer_content[$i][$j];
                        $updating_rate = Rating::find($request->answer_content[$i][$j]);
                        $updating_rate->active += 1;
                        $updating_rate->save();
                    }
                    else {
                        $answer .= ':' . $request->answer_content[$i][$j];
                        $updating_rate = Rating::find($request->answer_content[$i][$j]);
                        $updating_rate->active += 1;
                        $updating_rate->save();
                    }
                }
            }
            else if($question->rating_cat_id == 2) {
                $answer = $request->answer_content[$i][0];
            }
            else if($question->rating_cat_id == 3){
                $answer = $request->answer_content[$i][0];
            }

            $question->answer = $answer;
            $question->save();
        }
        
        $request->session()->flash('success', 'Saved Successfully');
        return redirect()->route('user.survey.list');
    }

    public function edit(Request $request)
    {
        $survey_id = $request->survey_id;
        $survey = Surveys::find($survey_id);
        if($survey->status == 'ready') {
            $request->session()->flash('error', 'This survey is running, you could not edit this survey!');
            return redirect()->back();
        }
        else {
            $languages = Languages::all();
            $ratingcats = RatingCat::all();
            $branches = Branchs::where('owner_id', Auth::user()->id)->get();
            $ratings = Rating::where('category_id', 1)->where('owner_id', Auth::user()->id)->get();

            
            $questions = Questions::where('survey_id', $survey_id)->get();
            return view('user.survey.edit', compact('survey', 'questions', 'languages', 'ratingcats', 'ratings', 'branches'));
        }
    }

    /**
     * Update the survey.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $rule = [
            'name' => 'required',
            'branch' => 'required',
            'description' => 'required',
            'languages.*' => 'required',
            'question_description.*' => 'required',
            'question_cat.*' => 'required',
            'answer_content.*.*' => 'required',
        ];

        $customMessages = [
            'languages.*.required' => 'Languages did not be entered exactly, please check it agian',
            'question_description.*.required' => 'Question Description did not be entered exactly, please check it agian',
            'question_cat.*.required' => 'Rating Category did not be entered exactly, please check it agian',
            'question_cat.*.required' => 'Rating Category did not be entered exactly, please check it agian',
            'answer_content.*.*.required' => 'Answer did not be entered exactly, please check it agian',
        ];

        $this->validate($request, $rule, $customMessages);

        $languages = $request->languages;
        $lang_text = '';
        for($i=0; $i<count($languages); $i++) {
            if($i==0) {
                $lang_text .= $languages[$i];
            }
            else {
                $lang_text .= ':' . $languages[$i];
            }
        }

        $kk = 0;
        $answer_temp = array();
        foreach($request->answer_content as $as) {
            $answer_temp[$kk] = $as;
            $kk++;
        }

        $survey_id = $request->survey_id;
        $survey = Surveys::find($survey_id);

        $survey->user_id = Auth::user()->id;
        $survey->branch_id = $request->branch;
        $survey->name = $request->name;
        $survey->description = $request->description;
        $survey->languages = $lang_text;
        $survey->status = 'draft';

        $survey->save();

        $new_question_id = array();
        $old_question_id = Questions::where('survey_id', $survey_id)->pluck('id')->toArray();        

        for($i=0; $i<count($request->question_description); $i++) {
            
            if($request->question_id[$i] == NULL) {
                $question = new Questions;
            }
            else{
                array_push($new_question_id, intval($request->question_id[$i]));
                $question = Questions::find($request->question_id[$i]);
            }

            $question->survey_id = $survey->id;
            $question->description = $request->question_description[$i];
            $question->class = $request->question_class[$i];
            $question->rating_cat_id = $request->question_cat[$i];

            if($question->rating_cat_id == 1) {
                $answer = '';
                for($j=0; $j<count($answer_temp[$i]); $j++) {
                    if($j == 0) {
                        $answer .= $answer_temp[$i][$j];
                        $updating_rate = Rating::find($request->answer_content[$i][$j]);
                        $updating_rate->active += 1;
                        $updating_rate->save();
                    }
                    else {
                        $answer .= ':' . $answer_temp[$i][$j];
                        $updating_rate = Rating::find($request->answer_content[$i][$j]);
                        $updating_rate->active += 1;
                        $updating_rate->save();
                    }
                }
            }
            else if($question->rating_cat_id == 2) {
                $answer = $answer_temp[$i][0];
            }
            else if($question->rating_cat_id == 3){
                $answer = $answer_temp[$i][0];
            }

            $question->answer = $answer;
            $question->save();
        }

        $diff_arr = array_diff($old_question_id, $new_question_id);
        foreach($diff_arr as $df) {
            Questions::find($df)->delete();
        }

        $request->session()->flash('success', 'Saved Successfully');
        return redirect()->route('user.survey.list');
    }

    /**
     * Delete the survey.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $survey_id = $request->survey_id;
        if(Surveys::find($survey_id)->status == 'ready') {
            echo 'running';
        }
        else {
            if(Surveys::where('id', $survey_id)) {
                $questions = Questions::where('survey_id', $survey_id)->get();
                for($i=0;$i<count($questions);$i++) {
                    if(strpos($questions[$i]->answer, ":") == false) {
                        $updating_rate = Rating::find($question->answer);
                        $updating_rate->active -= 1;
                        $updating_rate->save();
                    }
                    else {
                        $ratings = explode(":", $questions[$i]->answer);
                        for($j=0; $j<count($ratings); $j++) {
                            $updating_rate = Rating::where('id',$ratings[$j])->first();
                            $updating_rate->active -= 1;
                            $updating_rate->save();
                        }
                    }
                }
                Surveys::where('id', $survey_id)->delete();
                Questions::where('survey_id', $survey_id)->delete();
                echo 'success';
            }
        }
    }

    /**
     * Set the status of Survey
     * 
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $survey_id = $request->survey_id;
        $selected = Surveys::find($survey_id);
        $exist = Surveys::where('status', '=', 'ready')->where('user_id', Auth::user()->id)->where('branch_id', $selected->branch_id)->first();
        if($exist) {
            $exist->status = 'draft';
            $exist->save();
        }
        $survey = Surveys::find($survey_id);
        $survey->status = 'ready';
        $survey->save();
        
        echo 'success';
    }
}
