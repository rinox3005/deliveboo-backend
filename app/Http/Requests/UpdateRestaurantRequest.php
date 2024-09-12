<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Puoi usare la logica di autorizzazione se necessario, per ora restituisce true
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'piva' => 'required|string|size:11|unique:restaurants,piva,' . $this->restaurant->id,
            'type_id' => 'nullable|exists:types,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome del ristorante è obbligatorio.',

            'address.required' => 'L\'indirizzo del ristorante è obbligatorio.',
            'address.max' => 'L\'indirizzo del ristorante non può superare i 255 caratteri.',

            'city.required' => 'La città è obbligatoria.',

            'phone_number.required' => 'Il numero di telefono è obbligatorio.',
            'phone_number.max' => 'Il numero di telefono non può superare i 20 caratteri.',

            'piva.required' => 'La partita IVA è obbligatoria.',
            'piva.size' => 'La partita IVA deve essere di 11 caratteri.',
            'piva.unique' => 'La partita IVA inserita è già associata a un altro ristorante.',

            'image_path.image' => 'Il file caricato deve essere un\'immagine.',
            'image_path.mimes' => 'L\'immagine deve essere in uno dei seguenti formati: jpeg, png, jpg, gif, svg.',
            'image_path.max' => 'L\'immagine non può essere più grande di 2 MB.',
        ];
    }
}
