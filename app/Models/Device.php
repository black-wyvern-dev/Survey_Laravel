<?php

namespace App\Models;

use App\Models\Branchs;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "devices";
    
    protected $fillable = [
        'name', 'mac_num', 'branch_id', 'owner_id'
    ];
    
    public function get_branch($id) {
        return Branchs::find($id)->name;
    }
}
