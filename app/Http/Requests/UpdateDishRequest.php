<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assicurati che l'utente sia autorizzato ad eseguire questa richiesta
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
            'image_path' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048', // Aggiunto il formato webp
            'vegan' => 'nullable|boolean',
            'gluten_free' => 'nullable|boolean',
            'spicy' => 'nullable|boolean',
            'lactose_free' => 'nullable|boolean',
            'visible' => 'nullable|boolean',
        ];
    }
}
