<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use App\Models\DishOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DishOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito i vincoli delle chiavi esterne per evitare problemi durante il truncate
        Schema::disableForeignKeyConstraints();

        // Svuoto la tabella prima di inserire nuovi record
        DishOrder::truncate();

        // Recupera tutti gli ordini
        $orders = Order::all();

        // Esegui un ciclo su ciascun ordine
        foreach ($orders as $order) {
            // Recupera i piatti associati al ristorante dell'ordine
            $dishesForRestaurant = Dish::where('restaurant_id', $order->restaurant_id)->inRandomOrder()->get();

            // Se l'ordine non ha piatti associati, salta all'ordine successivo
            if ($dishesForRestaurant->isEmpty()) {
                continue;
            }

            // Determina un numero casuale di piatti da associare a ogni ordine, minimo 1, massimo 5
            $numberOfDishes = rand(1, min(5, $dishesForRestaurant->count()));

            // Seleziona piatti casuali senza ripetizioni
            $selectedDishes = $dishesForRestaurant->take($numberOfDishes);

            // Associa ciascun piatto all'ordine
            foreach ($selectedDishes as $dish) {
                $new_dish_order = new DishOrder();

                // Assegna l'ID del piatto e dell'ordine
                $new_dish_order->dish_id = $dish->id;
                $new_dish_order->order_id = $order->id;

                // Aggiungi una quantità casuale tra 1 e 5
                $new_dish_order->quantity = rand(1, 5);

                // Salva l'associazione nella tabella pivot
                $new_dish_order->save();
            }
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
