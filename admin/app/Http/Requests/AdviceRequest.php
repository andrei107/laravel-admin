<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdviceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'id' => 'required|integer',
            'img' =>  'image|mimes:jpg,jpeg,png',
            'name_ru' => 'required|string|max:200',
            'name_en' => 'required|string|max:200',
            'short_ru' => 'required|string|max:1000',
            'short_en' => 'required|string|max:1000',
            'full_description_ru' => 'required|string',
            'full_description_en' => 'required|string',
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
