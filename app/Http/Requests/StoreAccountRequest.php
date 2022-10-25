<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
     protected function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if (! $this->isPrecognitive()){
               if(empty($validator->failed())){

               }else{


               }

            }

        });
    }

    public function rules()
    {
        return [
            'pseudo' => 'required|unique:users',
            'password' => 'required|min:6',
            'confpassword' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'pseudo.required' => 'Votre pseudo est requis',
            'pseudo.unique' => 'Votre pseudo est déjà utilisé',
            'password.required' => 'Votre mot de passe est requis',
            'password.min' => 'Votre mot de passe doit faire + de 6 caracteres',
            'confpassword.required' => 'Votre confirmation de mot de passe est requis',
            'confpassword.same' => 'Votre confirmation doit correspondre avec votre mot de passe',
        ];

    }
}
