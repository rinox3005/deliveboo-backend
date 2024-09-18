<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logica per recuperare ordini (potrebbe includere filtraggio per ristorante/utente)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione dei dati
        $data = $request->validate([
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'user_name' => 'required|string|max:50',
            'user_email' => 'required|string|max:50|email',
            'user_address' => 'required|string|max:100',
            'user_phone' => 'required|string|max:20',
            'delivery_time' => 'required|date_format:H:i',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:255',
            'dishes' => 'required|array',
            'dishes.*.id' => 'required|integer|exists:dishes,id',
            'dishes.*.quantity' => 'required|integer|min:1',
        ]);

        // Creazione dell'ordine
        $order = new Order();
        $order->restaurant_id = $data['restaurant_id'];
        $order->user_name = $data['user_name'];
        $order->user_email = $data['user_email'];
        $order->user_address = $data['user_address'];
        $order->user_phone = $data['user_phone'];
        $order->order_date_time = now(); // Timestamp corrente
        $order->delivery_date = now()->toDateString(); // Data corrente
        $order->delivery_time = $data['delivery_time'];
        $order->total_price = $data['total_price'];
        $order->slug = 'temp-slug';
        $order->notes = $data['notes'] ?? null;

        $order->save();

        // Genera lo slug finale utilizzando l'ID dell'ordine
        $order->slug = 'NO' . $order->id;

        // Salva nuovamente l'ordine con lo slug aggiornato
        $order->save();

        // Associa i piatti all'ordine nella tabella pivot
        foreach ($data['dishes'] as $dish) {
            $order->dishes()->attach($dish['id'], ['quantity' => $dish['quantity']]);
        }

        return response()->json(['message' => 'Ordine creato con successo', 'order' => $order], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostra l'ordine specifico
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Aggiorna l'ordine
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Elimina l'ordine
    }
}
