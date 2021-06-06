<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'template';

    protected $fillable = ['id', 'name', 'owner_id', 'description', 'header_left', 'header_center', 'header_right', 'footer_left', 'footer_center', 'footer_right', 'status'];
}
