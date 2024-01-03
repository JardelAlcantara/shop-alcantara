<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string','min:3', 'max:50'],
            'phone' => ['required', 'unique:users,phone,'.Auth::user()->id],
            'email' => ['required', 'unique:users,email,'.Auth::user()->id],
            'picture' => ['nullable','image','dimensions:max_width=1000,max_height=1000', 'max:1048', 'mimes:png,jpeg,jpg'],
        ];
        return $rules;
    }


    protected function failedValidation(Validator $validator)
    {
        toastr($validator->errors()->first(),'warning');
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
