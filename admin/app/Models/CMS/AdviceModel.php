<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class AdviceModel extends Model
{
    protected $table = 'articles';
    public $timestamps = false;
    protected $fillable = [
        'name_ru',
        'name_en',
        'short_ru',
        'short_en',
        'img',
        'full_description_ru',
        'full_description_en',
    ];

}
