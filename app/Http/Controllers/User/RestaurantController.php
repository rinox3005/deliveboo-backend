<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni solo i ristoranti dell'utente loggato
        $userId = auth()->id();
        $restaurants = Restaurant::where('user_id', $userId)->get();

        return view('user.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types =  Type::all();

        return view('user.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        // Valida i dati
        $validated = $request->validated();

        // Crea un nuovo oggetto ristorante
        $restaurant = new Restaurant($validated);

        // Gestione del caricamento dell'immagine
        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('restaurants', 'public');

            // Prepara il percorso da salvare nel database nel formato corretto
            $restaurant->image_path = "/storage/{$path}";
        }

        // Associa il ristorante all'utente loggato
        $restaurant->user_id = auth()->id();

        // Genera lo slug basato sul nome e assegna al modello
        $restaurant->slug = Str::slug($validated['name']);

        // Salva il ristorante
        $restaurant->save();

        // Reindirizza alla pagina dell'indice dei ristoranti
        return redirect()->route('user.restaurants.index')->with('success', 'Ristorante creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.restaurants.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.restaurants.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
