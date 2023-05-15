<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{
    protected $table = 'filter_values';
    public $timestamps = false;
    protected $fillable = [
        'type_code',
        'value_ru',
        'value_en',
        'value'
    ];
}
