<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //tableau
            // voir les autres validation sur le net
            // il faut un tire
            // il faut un titre unique qui se refaire a la table ads qu'on a crée
            'title'=>'required|unique:ads',
            'description'=> 'required',
            'price'=>'integer|required',
            'localisation'=>'required',
        ];
    }
}
