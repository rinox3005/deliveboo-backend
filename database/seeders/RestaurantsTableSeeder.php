<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\User; // Importa il modello User
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Restaurant::truncate();

        // Crea un'istanza di Faker per generare dati casuali
        $faker = Faker::create();

        // Definisci un array di ristoranti con 5 ristoranti casuali
        for ($i = 0; $i < 10; $i++) {

            $restaurant = new Restaurant();

            // Seleziona un utente casuale dal database per assegnarlo al ristorante
            $restaurant->user_id = User::inRandomOrder()->first()->id;

            $restaurant->name = $faker->company;
            $restaurant->address = $faker->address;
            $restaurant->city = $faker->city;
            $restaurant->phone_number = $faker->phoneNumber; //
            $restaurant->piva = $faker->numerify('###########');
            $restaurant->slug = Str::slug($restaurant->name);
            $restaurant->image_path = $faker->imageUrl(640, 480, 'food', true);

            $restaurant->save();
        }

        Schema::enableForeignKeyConstraints();
    }
}
