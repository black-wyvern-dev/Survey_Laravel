<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'companyinfos';

    protected $fillable = [
        'name', 'url', 'category_id', 'owner_id'
    ];

    public function get_social($category_id) {
        if($category_id == 1) {
            return '<span><i class="fab fa-google"></i></span> Google';
        }
        else if($category_id == 2) {
            return '<span><i class="fab fa-facebook"></i></span> FaceBook';
        }
        else if($category_id == 3) {
            return '<span><i class="fab fa-linkedin"></i></span> Linked In';
        }
        else if($category_id == 4) {
            return '<span><i class="fab fa-instagram"></i></span> Instagram';
        }
    }
}
