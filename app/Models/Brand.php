<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;

    protected $with = ['translations'];
    public $translatedAttributes = ['name'];

    protected $fillable = ['is_active', 'photo'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    
    public function getActive(){
        return $this -> is_active == 0 ? __('admin\general.isNotActive') : __('admin\general.isActive');
    }
    
    public function getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";
    }

}
