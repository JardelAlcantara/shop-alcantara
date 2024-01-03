<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'passwordOld' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'passwordOld.required' => 'A senha antiga é obrigatorio',
            'password.required' => "Informe a nova senha.",
            'password.confirmed' => "As senhas digitadas não coincidem"
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        toastr($validator->errors()->first(),'warning');
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
