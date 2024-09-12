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
            'piva' => 'required|string|size:11|unique:restaurants,piva',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type_id' => 'nullable|exists:types,id',
            'types' => 'required|array|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome del ristorante è obbligatorio.',
            'name.max' => 'Il nome del ristorante non può superare i 255 caratteri.',

            'address.required' => 'L\'indirizzo del ristorante è obbligatorio.',
            'address.max' => 'L\'indirizzo del ristorante non può superare i 255 caratteri.',

            'city.required' => 'La città è obbligatoria.',

            'phone_number.required' => 'Il numero di telefono è obbligatorio.',

            'piva.required' => 'La partita IVA è obbligatoria.',
            'piva.size' => 'La partita IVA deve essere di 11 caratteri.',
            'piva.unique' => 'La partita IVA inserita è già associata a un altro ristorante.',

            'image_path.image' => 'Il file caricato deve essere un\'immagine.',
            'image_path.mimes' => 'L\'immagine deve essere in uno dei seguenti formati: jpeg, png, jpg, gif, svg.',
            'image_path.max' => 'L\'immagine non può essere più grande di 2 MB.',

            'types.required' => 'Devi selezionare almeno un tipo di ristorante.',
        ];
    }
}
