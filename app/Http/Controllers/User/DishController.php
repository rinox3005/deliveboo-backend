<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostra tutti i piatti associati al ristorante dell'utente loggato
        $dishes = Dish::where('restaurant_id', auth()->user()->restaurant->id)->get();
        return view('user.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ottieni il ristorante associato all'utente loggato
        $restaurant = auth()->user()->restaurant;

        return view('user.dishes.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        $data = $request->validated();

        // Aggiungi lo slug basato sul nome del piatto
        $data['slug'] = Str::slug($data['name']);

        // Imposta i campi booleani su 0 se non sono selezionati
        $data['vegan'] = $request->has('vegan') ? 1 : 0;
        $data['gluten_free'] = $request->has('gluten_free') ? 1 : 0;
        $data['spicy'] = $request->has('spicy') ? 1 : 0;
        $data['lactose_free'] = $request->has('lactose_free') ? 1 : 0;
        $data['visible'] = $request->has('visible') ? 1 : 0;

        // Gestione del caricamento dell'immagine
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');

            // Controllo dell'estensione per garantire che sia un'immagine
            $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
            $extension = $file->getClientOriginalExtension();

            if (!in_array(strtolower($extension), $allowedExtensions)) {
                return redirect()->back()->withErrors('Il file caricato non è un\'immagine valida.');
            }

            // Salva l'immagine
            $fileName = $file->getClientOriginalName();
            $imagePath = $file->storeAs('dishes', $fileName, 'public');
            $data['image_path'] = '/storage/' . $imagePath;
        }

        // Verifica che l'utente loggato abbia un ristorante associato
        if (!auth()->user()->restaurant) {
            return redirect()->back()->withErrors('Devi avere un ristorante associato per creare un piatto.');
        }

        // Associa il piatto al ristorante dell'utente loggato
        $data['restaurant_id'] = auth()->user()->restaurant->id;

        // Crea il piatto
        Dish::create($data);

        // Ottieni il ristorante associato al piatto
        $restaurant = auth()->user()->restaurant;

        // Reindirizza alla pagina di show del ristorante
        return redirect()->route('user.restaurants.show', $restaurant)->with('message', 'Piatto creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {

        // Ottieni il ristorante associato al piatto
        $restaurant = $dish->restaurant;

        return view('user.dishes.show', compact('dish', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        // Ottieni il ristorante associato all'utente loggato
        $restaurant = auth()->user()->restaurant;

        return view('user.dishes.edit', compact('dish', 'restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        // Verifica che il piatto appartenga al ristorante dell'utente loggato
        if ($dish->restaurant_id !== auth()->user()->restaurant->id) {
            abort(403);
        }

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        // Imposta i campi booleani su 0 se non sono selezionati
        $data['vegan'] = $request->has('vegan') ? 1 : 0;
        $data['gluten_free'] = $request->has('gluten_free') ? 1 : 0;
        $data['spicy'] = $request->has('spicy') ? 1 : 0;
        $data['lactose_free'] = $request->has('lactose_free') ? 1 : 0;
        $data['visible'] = $request->has('visible') ? 1 : 0;

        // Gestione del caricamento dell'immagine
        if ($request->hasFile('image_path')) {
            // Elimina la vecchia immagine, se esiste
            if ($dish->image_path) {
                $oldFilePath = str_replace('storage/', '', $dish->image_path);
                Storage::disk('public')->delete($oldFilePath);
            }

            $file = $request->file('image_path');

            // Controllo dell'estensione per garantire che sia un'immagine
            $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
            $extension = $file->getClientOriginalExtension();

            if (!in_array(strtolower($extension), $allowedExtensions)) {
                return redirect()->back()->withErrors('Il file caricato non è un\'immagine valida.');
            }

            // Salva la nuova immagine
            $fileName = $file->getClientOriginalName();
            $imagePath = $file->storeAs('dishes', $fileName, 'public');
            $data['image_path'] = '/storage/' . $imagePath;
        } else {
            $data['image_path'] = $dish->image_path;
        }

        // Associa il piatto al ristorante dell'utente loggato
        $data['restaurant_id'] = auth()->user()->restaurant->id;

        // Aggiorna i dati del piatto
        $dish->update($data);

        // Ottieni il ristorante associato al piatto
        $restaurant = auth()->user()->restaurant;

        return redirect()->route('user.restaurants.show', $restaurant)->with('message', 'Piatto aggiornato con successo');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        // Verifica che il piatto appartenga al ristorante dell'utente loggato
        if ($dish->restaurant_id !== auth()->user()->restaurant->id) {
            abort(403);
        }

        // Ottieni il ristorante associato al piatto
        $restaurant = $dish->restaurant;

        // Elimina l'immagine associata
        if ($dish->image_path) {
            $filePath = str_replace('storage/', '', $dish->image_path);
            Storage::disk('public')->delete($filePath);
        }

        $dish->delete();

        return redirect()->route('user.restaurants.show', $restaurant)->with('message', 'Piatto eliminato con successo');
    }
}
