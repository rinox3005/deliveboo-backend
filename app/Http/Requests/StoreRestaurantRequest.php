<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determina se l'utente è autorizzato a fare questa richiesta.
     */
    public function authorize(): bool
    {
        // Assicurati che l'utente sia autorizzato a creare un ristorante
        return true; // Se hai logiche di autorizzazione specifiche, puoi gestirle qui
    }

    /**
     * Ottieni le regole di validazione che si applicano alla richiesta.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'piva' => 'required|string|max:11|unique:restaurants,piva',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type_id' => 'nullable|exists:types,id',
        ];
    }
}
