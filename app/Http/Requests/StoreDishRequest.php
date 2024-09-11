<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Permetti sempre l'autorizzazione per l'utente autenticato
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_path' => 'nullable|image|max:2048', // immagine opzionale, massimo 2MB
            'vegan' => 'nullable|boolean',
            'gluten_free' => 'nullable|boolean',
            'spicy' => 'nullable|boolean',
            'lactose_free' => 'nullable|boolean',
            'visible' => 'nullable|boolean',
        ];
    }
}
