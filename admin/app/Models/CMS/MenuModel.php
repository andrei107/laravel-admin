<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    public $timestamps = false;
    protected $fillable = [
        'menu_id',
        'name_ru',
        'name_en'
    ];

    public static function getMenu()
    {
        return self::query()->pluck('name_ru');
    }

    public static function getMenyByKey($key)
    {
        return self::query()
                ->where('menu_id', $key)
                ->first();
    }
}
