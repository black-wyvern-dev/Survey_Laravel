<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branchs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @param array
     */
    protected $table = 'branchs';
    
    protected $fillable = [
        'name', 'country', 'city', 'picture', 'owner_id', 'manager_id',
    ]; 
    
    public static function getById($id)
    {
        return (
        $branches  = self::where('id', '=', $id)
            ->limit(1)
            ->get()
        ) &&
            count($branches) ===1
        ? $branches[0]
        : null;
    }

    public static function destroy($id)
    {
        return self::where([
            'id' => $id
        ])->delete();
    }

    public static function getAllByOwner($owner_id)
    {
        $branchs = self::where('owner_id', '=', $owner_id)
            ->orderBy('updated_at', 'desc')->get();
        return $branchs;
    }

    public static function getArrayByOwner($owner_id) {
        $branchs = self::select('id')->where('owner_id', '=', $owner_id)
        ->orderBy('updated_at', 'desc')->pluck('id')->toArray();

        return $branchs;
    }

    public static function updatedByUser($branch_id, $manager_id) {
        $update = self::find($branch_id);
        $update->manager_id = $manager_id;
        $update->save();
    }

    public function getManager() {
        return $this->hasOne('App\Models\User','id','manager_id');
    }
}
