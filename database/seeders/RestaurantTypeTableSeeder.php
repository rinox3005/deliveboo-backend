<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Type;
use App\Models\RestaurantType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RestaurantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito i vincoli delle chiavi esterne per evitare problemi durante il truncate
        Schema::disableForeignKeyConstraints();

        // Svuoto la tabella prima di inserire nuovi record
        RestaurantType::truncate();

        // Recupera tutti i ristoranti
        $restaurants = Restaurant::all();

        // Assicura che ogni ristorante abbia almeno un tipo associato
        foreach ($restaurants as $restaurant) {
            // Seleziona un numero casuale di tipi (almeno 1) da associare a ogni ristorante
            $numberOfTypes = rand(1, 3);
            $types = Type::inRandomOrder()->take($numberOfTypes)->pluck('id');

            // Associa i tipi al ristorante
            foreach ($types as $typeId) {
                RestaurantType::create([
                    'restaurant_id' => $restaurant->id,
                    'type_id' => $typeId,
                ]);
            }
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
