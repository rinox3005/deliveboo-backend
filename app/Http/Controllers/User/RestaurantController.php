<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        // Aggiungo i tipi di ristorante
        if ($request->has('types')) {
            $restaurant->types()->attach($request->types);
        }

        // Reindirizza alla pagina dell'indice dei ristoranti
        return redirect()->route('user.dashboard')->with('success', 'Ristorante creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        // Verifica che il ristorante appartenga all'utente loggato
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        // Carica i piatti associati al ristorante
        $dishes = $restaurant->dishes;

        // Ottieni la data odierna con Carbon
        $today = Carbon::today();

        // Carica gli ultimi 10 ordini ricevuti in data odierna, ordinati per data decrescente
        $recentOrders = $restaurant->orders()
            ->whereDate('order_date_time', $today) // Filtra solo gli ordini di oggi
            ->latest('order_date_time') // Ordina per data di ordine decrescente
            ->take(10) // Prendi solo i 10 più recenti
            ->get();

        return view('user.restaurants.show', compact('restaurant', 'dishes', 'recentOrders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        // Verifica che il ristorante appartenga all'utente loggato
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        // Recupera i tipi di ristorante disponibili
        $types = Type::all();

        return view('user.restaurants.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        // Verifica che il ristorante appartenga all'utente loggato
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        // Gestione del caricamento dell'immagine
        if ($request->hasFile('preview')) {
            // Elimina la vecchia immagine, se esiste
            if ($restaurant->image_path) {
                $oldFilePath = str_replace('storage/', '', $restaurant->image_path);
                Storage::disk('public')->delete($oldFilePath);
            }

            // Salva la nuova immagine
            $file = $request->file('preview');
            $fileName = $file->getClientOriginalName();
            $imagePath = $file->storeAs('restaurants', $fileName, 'public');
            $data['image_path'] = '/storage/' . $imagePath;
        } else {
            $data['image_path'] = $restaurant->image_path;
        }

        // Aggiorna i dati del ristorante
        $restaurant->update($data);

        // Aggiorno le tipologie di ristorante
        if ($request->has('types')) {
            $restaurant->types()->sync($request->types);
        } else {
            $restaurant->types()->detach();
        }

        return redirect()->route('user.restaurants.show', $restaurant)->with('message', 'Ristorante ' . $restaurant->name . ' aggiornato con successo');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        // Verifica che il ristorante appartenga all'utente loggato
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        // Elimina l'immagine associata se esiste
        if ($restaurant->image_path) {
            $filePath = str_replace('storage/', '', $restaurant->image_path);
            Storage::disk('public')->delete($filePath);
        }
        // Elimina il ristorante
        $restaurant_name = $restaurant->name;
        $restaurant->delete();

        return redirect()->route('user.dashboard')->with('message', 'Ristorante ' . $restaurant_name . ' eliminato con successo');
    }



    // //(LM) metodo apiIndex per restituire i ristoranti in formato JSON
    // public function apiIndex()
    // {

    //     //si ottengono tutti i ristoranti
    //     $restaurants = Restaurant::with('types')->get();

    //     //restituzione dati in formato json
    //     return response()->json($restaurants);
    // }
}
