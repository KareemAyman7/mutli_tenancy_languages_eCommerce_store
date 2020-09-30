<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $with = ['translations'];
    public $translatedAttributes = ['name'];

    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = ['translations'];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function scopeParent($query){
        $query -> whereNull('parent_id');
    }
    
    public function scopeChild($query){
        $query -> whereNotNull('parent_id');
    }
    
    public function getActive(){
        return $this -> is_active == 0 ? __('admin\general.isNotActive') : __('admin\general.isActive');
    }
    
    public function getType(){
        return $this -> parent_id == null ? __('admin\categories.type_main_cat') : __('admin\categories.type_sub_cat');
    }

    public function subcats()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent_cat()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }



}
