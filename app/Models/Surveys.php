<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Languages;
class Surveys extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @param array
     */
    protected $table = 'surveys';

    protected $fillable = [
        'user_id', 'branch_id', 'name', 'description', 'languages', 'status'
    ];
    
    public function getBranch() {
        return $this->hasOne('App\Models\Branchs','id','branch_id');
    }

    public function getLanguages($languages) {
        $lang_arr = explode(':', $languages);

        $languages_text = '';
        if($languages != '') {
            for($i=0; $i<count($lang_arr); $i++) {
                if($i == 0) {
                    $languages_text .= Languages::find($lang_arr[$i])->name;
                }
                else {
                    $languages_text .= ', ' . Languages::find($lang_arr[$i])->name;
                }
            }
        }

        return $languages_text;
    }

}