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
}
