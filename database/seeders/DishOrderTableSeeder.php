<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use App\Models\DishOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // Esegui un ciclo per creare 10 associazioni casuali tra piatti e ordini
        for ($i = 0; $i < 20; $i++) {
            $new_dish_order = new DishOrder();

            // Associo un piatto casuale
            $new_dish_order->dish_id = Dish::inRandomOrder()->first()->id;

            // Associo un ordine casuale
            $new_dish_order->order_id = Order::inRandomOrder()->first()->id;

            // Aggiungo una quantità casuale tra 1 e 5
            $new_dish_order->quantity = rand(1, 5);

            // Salva l'associazione nella tabella pivot
            $new_dish_order->save();
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
