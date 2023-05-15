<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class FilterTypes extends Model
{
    protected $table = 'filter_types';
    public $timestamps = false;
    protected $fillable = [
        'type_code',
        'name_ru',
        'name_en',
        'activity'
    ];
}
