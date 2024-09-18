<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni l'utente loggato
        $user = auth()->user();

        // Recupera il ristorante dell'utente loggato
        $restaurant = $user->restaurant;

        // Recupera gli ordini associati al ristorante, ordinati per order_date_time decrescente e paginati
        $orders = $restaurant->orders()->orderBy('order_date_time', 'desc')->paginate(10);

        // Passa sia gli ordini che il ristorante alla vista
        return view('user.orders.index', compact('orders', 'restaurant'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Verifica che l'ordine appartenga al ristorante dell'utente loggato
        if ($order->restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        // Carica i piatti associati all'ordine
        $dishes = $order->dishes;  // Supponendo che la relazione si chiami 'dishes'

        return view('user.orders.show', compact('order', 'dishes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
