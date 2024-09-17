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
            'Poke Bowl',
            'Spaghetti allo Scoglio',
            'Fettuccine Alfredo',
            'Tagliata di Manzo',
            'Polenta con Funghi',
            'Gamberi alla Griglia',
            'Caponata Siciliana',
            'Parmigiana di Melanzane',
            'Pollo alla Cacciatora',
            'Trippa alla Fiorentina',
            'Vitello Tonnato',
            'Pasta alla Norma',
            'Focaccia Genovese',
            'Piadina Romagnola',
            'Riso alla Cantonese',
            'Zuppa di Misso',
            'Riso Venere con Verdure',
            'Insalata Greca',
            'Zuppa di Cipolle',
            'Orecchiette con Cime di Rapa',
            'Arancini di Riso',
            'Bruschetta al Pomodoro',
            'Polpo alla Griglia',
            'Tagliolini al Tartufo',
            'Tiramisù',
            'Panna Cotta',
            'Cheesecake al Limone',
            'Cannoli Siciliani',
            'Torta Caprese',
            'Tartufo di Pizzo',
            'Torta della Nonna'
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
            'Un piatto ricco di sapori naturali e freschi.',
            'Ricco di pesce fresco e con un sapore intenso.',
            'Un classico della cucina americana con un tocco italiano.',
            'Carne di qualità cucinata alla perfezione.',
            'Polenta cremosa con funghi freschi.',
            'Gamberi croccanti e saporiti alla griglia.',
            'Un piatto siciliano con un mix di sapori dolci e salati.',
            'Cremosa, ricca e piena di sapori mediterranei.',
            'Una deliziosa combinazione di carne e verdure.',
            'Una specialità toscana dal sapore deciso.',
            'Carne tenera con una salsa cremosa e delicata.',
            'Un piatto siciliano pieno di storia e gusto.',
            'Pane croccante con un condimento semplice ma irresistibile.',
            'Una specialità romagnola ripiena di sapori.',
            'Un classico piatto cinese amato in tutto il mondo.',
            'Un piatto leggero e salutare dal Giappone.',
            'Un riso particolare con un mix di verdure.',
            'Una fresca insalata greca con feta e olive.',
            'Un piatto francese perfetto per le fredde giornate invernali.',
            'Un piatto pugliese ricco di tradizione.',
            'Deliziosi bocconi di riso croccanti e saporiti.',
            'Pane croccante condito con pomodori freschi e basilico.',
            'Polpo tenero e grigliato alla perfezione.',
            'Una prelibatezza con il gusto intenso del tartufo.',
            'Il dolce italiano più amato nel mondo.',
            'Un dessert delicato e cremoso.',
            'Un dolce fresco e agrumato perfetto per ogni occasione.',
            'Il dolce siciliano più famoso, con ricotta e cioccolato.',
            'Una torta al cioccolato con un cuore tenero e saporito.',
            'Un dolce calabrese dal gusto intenso.',
            'Un dolce tradizionale dal sapore casalingo e genuino.'
        ];

        // Recupero tutti i ristoranti
        $restaurants = Restaurant::all();

        // Assegno piatti a ciascun ristorante
        foreach ($restaurants as $restaurant) {
            // Genero un numero casuale di piatti per ogni ristorante (minimo 10, massimo 30)
            $numberOfDishes = rand(10, 30);

            for ($i = 0; $i < $numberOfDishes; $i++) {
                // Prendo un nome di piatto casuale dalla lista
                $name = $dishNames[array_rand($dishNames)];
                $description = $descriptions[array_rand($descriptions)];

                $dish = new Dish();
                $dish->restaurant_id = $restaurant->id;
                $dish->name = $name;
                $dish->description = $description;
                $dish->price = rand(5, 30);
                $dish->vegan = rand(0, 1);
                $dish->gluten_free = rand(0, 1);
                $dish->spicy = rand(0, 1);
                $dish->lactose_free = rand(0, 1);
                $dish->visible = true;
                $dish->slug = Str::slug($name);

                // Salvo il piatto
                $dish->save();
            }
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
