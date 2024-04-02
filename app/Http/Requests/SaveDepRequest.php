<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveDepRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'nom_departement' => 'required|unique:departements,name'
        ];
    }

    public function messages()
    {
        return ['nom_departement.required' => 'le nom du departement est requis', 'nom_departement.unique' => 'cette departement est deja existe'];
    }
}
