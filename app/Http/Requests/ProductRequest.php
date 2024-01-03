<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class ProductRequest extends FormRequest
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
        $id = intval($this->produto);
        $rules = [];
        if (empty($id)) {
            $rules =  [
                'name' => ['required', 'string', 'min:2', 'max:50'],
                'quantyty' => ['required','integer'],
                'value' => ['required','integer'],
                'brand_id' => ['required',  'exists:App\Models\Brand,id'],
                'picture' => ['nullable', 'image', 'dimensions:max_width=1000,max_height=1000', 'max:1048', 'mimes:png,jpeg,jpg'],
                'description' => ['required'],
            ];
        } else {
            $rules =  [
                'name' => ['required', 'string', 'min:2', 'max:50'],
                'quantyty' => ['required','integer'],
                'value' => ['required','integer'],
                'brand_id' => ['required',  'exists:App\Models\Brand,id'],
                'picture' => ['nullable', 'image', 'dimensions:max_width=1000,max_height=1000', 'max:1048', 'mimes:png,jpeg,jpg'],
                'description' => ['required'],
            ];
        }
        return $rules;
    }


    protected function failedValidation(Validator $validator)
    {
        toastr($validator->errors()->first(), 'warning');
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
