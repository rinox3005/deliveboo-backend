<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class ApiRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function apiIndex(Request $request)
    {
        // Ottieni i types dalla query string (es. ?types=italian,mexican)
        $typeFilters = $request->query('types');

        // Se non ci sono filtri, ottieni tutti i ristoranti con i loro tipi
        $query = Restaurant::with('types');

        // Se ci sono filtri, filtra in base ai types selezionati
        if ($typeFilters) {
            $typesArray = explode(',', $typeFilters);
            $query->whereHas('types', function ($q) use ($typesArray) {
                $q->whereIn('name', $typesArray); // Filtra per nome del tipo
            });
        }

        $restaurants = $query->get();

        return response()->json($restaurants);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Ottieni il ristorante in base allo slug e carica i piatti
        $restaurant = Restaurant::with('dishes')->where('slug', $slug)->first();

        // Controlla se il ristorante esiste
        if (!$restaurant) {
            return response()->json(['message' => 'Ristorante non trovato'], 404);
        }

        // Restituisci il ristorante con piatti e tipi in formato JSON
        return response()->json($restaurant);
    }


    public function getTypes()
    {
        $types = Type::all();
        return response()->json($types);
    }
}
