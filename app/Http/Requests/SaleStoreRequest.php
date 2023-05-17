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
            'user_id' => ['required', 'exists:users,id', new ValidateTypeUser(TypeUser::TYPE_OWNER)],
            'client_id' => ['required', 'exists:users,id', new ValidateTypeUser(TypeUser::TYPE_CLIENT)],
        ];
    }
}
