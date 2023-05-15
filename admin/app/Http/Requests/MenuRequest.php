<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MenuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'menu_id' => 'required|string|max:5',
            'name_ru' => 'required|string|max:200',
            'name_en' => 'required|string|max:200',
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
