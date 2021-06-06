<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'id', 'survey_id', 'description', 'class', 'rating_cat_id', 'answer'
    ];
}
