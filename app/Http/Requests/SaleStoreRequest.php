<?php

namespace App\Http\Requests;

use App\Enums\TypeUser;
use App\Rules\ValidateTypeUser;
use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id', new ValidateTypeUser(TypeUser::TYPE_SELLER)],
            'client_id' => ['required', 'exists:users,id', new ValidateTypeUser(TypeUser::TYPE_CLIENT)],
            'items' => ['required', 'array'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.amount' => ['required', 'integer', 'min: 1'],
        ];
    }
}
