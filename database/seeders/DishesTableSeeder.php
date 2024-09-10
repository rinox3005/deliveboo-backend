<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DishesTableSeeder extends Seeder
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
        Dish::truncate();

        // Definisco un array di nomi di piatti
        $dishNames = [
            'Spaghetti Carbonara',
            'Pizza Margherita',
            'Sushi Maki',
            'Tacos al Pastor',
            'Pad Thai',
            'Burger Classico',
            'Lasagna',
            'Risotto ai funghi',
            'Pollo Tandoori',
            'Curry di verdure',
            'Ravioli di carne',
            'Paella',
            'Falafel',
            'Bistecca alla Fiorentina',
            'Fish and Chips',
            'Crepe',
            'Burrito',
            'Salmone grigliato',
            'Gnocchi al pesto',
            'Poke Bowl'
        ];

        // Definisco un array di descrizioni casuali
        $descriptions = [
            'Un piatto tipico della cucina italiana, amato in tutto il mondo.',
            'Un mix perfetto di sapori freschi e autentici.',
            'Cotto alla perfezione e servito con contorni deliziosi.',
            'Un piatto classico con un tocco di modernità.',
            'Preparato con ingredienti freschi e di alta qualità.',
            'Un esplosione di sapori che soddisferà ogni palato.',
            'Un piatto tradizionale ricco di storia e gusto.',
            'Una nuova opzione leggera e gustosa per ogni occasione.',
            'Perfetto per chi ama i piatti semplici ma gustosi.',
            'Una combinazione di ingredienti freschi e speziati.',
            'Cucina tradizionale con un twist moderno.',
            'Ricco di proteine e sapore, ottimo per una cena leggera.',
            'Un classico piatto rivisitato in chiave gourmet.',
            'Perfetto per chi ama i piatti saporiti e genuini.',
            'Un piatto esotico pieno di sapori internazionali.',
            'Leggero, delizioso e perfetto per ogni stagione.',
            'Una scelta nutriente e gustosa per ogni pasto.',
            'Un piatto fresco e salutare per chi è attento alla linea.',
            'Una ricetta tradizionale che non delude mai.',
            'Un piatto ricco di sapori naturali e freschi.'
        ];

        // Creo piatti casuali e associati a un ristorante
        foreach ($dishNames as $index => $name) {
            $dish = new Dish();

            // Associo il piatto a un ristorante casuale
            $dish->restaurant_id = Restaurant::inRandomOrder()->first()->id;

            // Dati del piatto
            $dish->name = $name;
            $dish->description = $descriptions[$index];
            $dish->price = rand(5, 30);
            $dish->vegan = rand(0, 1);
            $dish->gluten_free = rand(0, 1);
            $dish->spicy = rand(0, 1);
            $dish->lactose_free = rand(0, 1);
            $dish->visible = true;
            $dish->slug = Str::slug($name);

            // Salvo il piatto nel database
            $dish->save();
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
