<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class ReceiptModel extends Model
{
   protected $table = 'receipts';
   public $timestamps = false;

   protected $fillable = [
        'id',
        'name_ru',
        'name_en',
        'img',
        'time',
        'activity',
        'calories',
        'ingridients_ru',
        'ingridients_en',
        'receipt_ru',
        'receipt_en',
        'best',
        'day',
        'fast',
        'for_menu',
        'persons'
   ];


    public static function docs($callback, $category)
    {
        return self::query()->chunk(250, function($inspectors) use($callback, $category) {
            $preparedData = $inspectors->transform(function ($item, $key) use($callback, $category) {

                return [
                    'id' => $item->id,
                    'name_ru' => $item->name_ru,
                    'activity' => $item->activity,
                    'best' => $item->best,
                    'day' => $item->day,
                    'fast' => $item->fast,
                    'for_menu' => $item->for_menu,
                ];
            })->toArray();

            $callback($preparedData);
        });
    }
}
