<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReceiptRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'id' => 'required|integer',
            'calories' => 'required|integer',
            'persons' => 'required|integer',
            'time' => 'required|string',
            'img' =>  'required',
            'best' => 'required_if:activity,1',
            'fast' => 'required_if:activity,1',
            'day' => 'required_if:activity,1',
            'for_menu' => 'required_if:activity,1',
            'name_ru' => 'required|string|max:200',
            'name_en' => 'required|string|max:200',
            'ingridients_ru' => 'required|string|max:700',
            'ingridients_en' => 'required|string|max:700',
            'receipt_ru' => 'required|string',
            'receipt_en' => 'required|string',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'error' => 'validation',
                'message' => 'Проверьте введенные данные',
                'fields' => $validator->errors()->keys(),
            ])
        );
    }
}
