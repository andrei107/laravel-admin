<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class FilterModel extends Model
{
    protected $table = 'filters';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'type_ru',
        'type_en',
        'type_code',
    ];
}