<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class RestaurantsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito i vincoli delle chiavi esterne per evitare problemi durante il truncate
        Schema::disableForeignKeyConstraints();

        // Svuoto la tabella prima di inserire nuovi record
        Restaurant::truncate();

        // Crea un'istanza di Faker per generare dati casuali
        $faker = Faker::create();

        // Definisco un array di nomi di ristoranti italiani famosi
        $restaurantNames = [
            'Osteria Francescana',
            'La Pergola',
            'Enoteca Pinchiorri',
            'Piazza Duomo',
            'Le Calandre',
            'Dal Pescatore',
            'Reale',
            'Uliassi',
            'Il Luogo di Aimo e Nadia',
            'Cracco'
        ];

        // Definisco un array di indirizzi reali per i ristoranti
        $restaurantAddresses = [
            'Via Stella, 22, 41121 Modena MO',
            'Via Alberto Cadlolo, 101, 00136 Roma RM',
            'Via Ghibellina, 87, 50122 Firenze FI',
            'Piazza Risorgimento, 4, 12051 Alba CN',
            'Via Liguria, 1, 35030 Rubano PD',
            'Via Runate, 15, 46013 Canneto sull’Oglio MN',
            'Contrada Piana Santa Liberata, 67031 Castel di Sangro AQ',
            'Banchina di Levante, 6, 60019 Senigallia AN',
            'Via Montecuccoli, 6, 20147 Milano MI',
            'Galleria Vittorio Emanuele II, 20121 Milano MI'
        ];

        // Definisco un array di città per ogni ristorante
        $restaurantCities = [
            'Modena',
            'Roma',
            'Firenze',
            'Alba',
            'Rubano',
            'Canneto sull’Oglio',
            'Castel di Sangro',
            'Senigallia',
            'Milano',
            'Milano'
        ];

        // Definisco un array di numeri di telefono per ogni ristorante
        $restaurantPhones = [
            '059 223912',
            '06 35092152',
            '055 242757',
            '0173 366167',
            '049 630303',
            '0376 723001',
            '0864 69382',
            '071 65463',
            '02 416886',
            '02 72022464'
        ];

        // Creo ristoranti casuali con i nomi, indirizzi e altri dettagli
        foreach ($restaurantNames as $index => $name) {

            $restaurant = new Restaurant();

            // Seleziono un utente casuale dal database per assegnarlo al ristorante
            $restaurant->user_id = User::inRandomOrder()->first()->id;

            // Dati del ristorante
            $restaurant->name = $name;
            $restaurant->address = $restaurantAddresses[$index];
            $restaurant->city = $restaurantCities[$index];
            $restaurant->phone_number = $restaurantPhones[$index];
            $restaurant->piva = $faker->numerify('###########');
            $restaurant->slug = Str::slug($name);

            // Salvo il ristorante nel database
            $restaurant->save();
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
