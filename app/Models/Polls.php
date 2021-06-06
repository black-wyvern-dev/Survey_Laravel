<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
    protected $table = 'polls';
    /**
     * The attributes that are mass assignable.
     *
     * @param array
     */
    protected $fillable = [
        'owner_id', 'branch_id', 'agent_id', 'score', 'score_emp', 'score_ser', 'score_env', 'score_non',
    ]; 

    public function getBranch() {
        return $this->hasOne('App\Models\Branchs', 'id', 'branch_id');
    }

    public function getOwner() {
        return $this->hasOne('App\Models\User', 'id', 'owner_id');
    }

    public function getAgent() {
        return $this->hasOne('App\Models\User', 'id', 'agent_id');
    }

    
}
