<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEmployerRequest extends FormRequest
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
            'departement_id' => 'required|integer',
            'nom_employer'  => 'required|string',
            'prenom_employer'  => 'required|string',
            'email_employer'  => 'required|unique:employers,email',
            'phone_employer'  => 'required|unique:employers,contact',
            'montant_journalier'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email_employer.required' => 'lemail est requis',
            'email_employer.unique' => 'lemail est deja pris',
            'phone_employer.required' => 'ce numero est requis',
            'phone_employer.unique' => 'lemail est deja pris',
        ];
    }
}
