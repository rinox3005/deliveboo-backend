<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Type;
use App\Models\RestaurantType; // Modello per la tabella pivot (opzionale)
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

        // Esegui un ciclo per creare 10 associazioni casuali tra ristoranti e tipi di cucina
        for ($i = 0; $i < 10; $i++) {
            $new_restaurant_type = new RestaurantType();

            // Associa un ristorante casuale
            $new_restaurant_type->restaurant_id = Restaurant::inRandomOrder()->first()->id;

            // Associa un tipo di cucina casuale
            $new_restaurant_type->type_id = Type::inRandomOrder()->first()->id;

            // Salva l'associazione nella tabella pivot
            $new_restaurant_type->save();
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
