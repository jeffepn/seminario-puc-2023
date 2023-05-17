<?php

namespace App\Http\Requests;

use App\Enums\TypeUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
        //dd();
        return [
            'name' => [$sometimes, 'required', 'min:4', 'max:255'],
            'email' => [$sometimes, 'required', 'email', 'max: 255', Rule::unique('users', 'email')->ignore($this->user?->id)],
            'type' => [$sometimes, 'required', Rule::in([TypeUser::TYPE_OWNER, TypeUser::TYPE_CLIENT])]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute deve ser obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'unique' => 'Já existe um usuário com este :attribute.',
            'type.in' => 'O usuário deve ser do :attribute ' . TypeUser::TYPE_OWNER . ' ou ' . TypeUser::TYPE_CLIENT,
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome',
            'email' => 'e-mail',
            'type' => 'tipo'
        ];
    }
}
