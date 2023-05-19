<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $sometimes = null;
        if ($this->method() !== "POST") {
            $sometimes = 'sometimes';
        }

        return [
            'name' => [$sometimes, 'required', 'min:3', 'max:40'],
            'value' => [$sometimes, 'required', 'numeric', 'between:0,99999999.99']
        ];
    }
}
