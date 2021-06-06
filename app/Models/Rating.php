<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "ratings";

    protected $fillable = ['category_id', 'name', 'score', 'content', 'owner_id', 'active'];
}
