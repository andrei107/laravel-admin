<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterValuesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'type_code' => 'required',
            'value' => 'required|string|max:8',
            'value_ru' => 'required|string|max:200',
            'value_en' => 'required|string|max:200',
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
