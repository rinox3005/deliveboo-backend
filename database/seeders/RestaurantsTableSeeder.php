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
        $faker = Faker::create('it_IT');

        // Recupera tutti gli utenti esistenti
        $users = User::all();

        // Se ci sono meno di 40 utenti, interrompi la procedura
        if ($users->count() < 40) {
            $this->command->error('Non ci sono abbastanza utenti per creare 40 ristoranti.');
            return;
        }

        // Limita l'array di utenti a 40 utenti unici
        $users = $users->take(40);

        // Definisco un array di nomi di ristoranti italiani casuali
        $restaurantNames = [
            'La Cucina Milanese',
            'Trattoria da Luigi',
            'Il Gusto di Milano',
            'Sapori di Milano',
            'Il Ristoro Lombardo',
            'Osteria del Naviglio',
            'La Terrazza',
            'Ristorante Brera',
            'Il Castello Sforzesco',
            'La Madonnina',
            'La Scala',
            'Piazza del Duomo',
            'Bistrot Milano',
            'Ristorante Porta Venezia',
            'Trattoria La Scala',
            'Osteria Porta Romana',
            'Ristorante Milano Centro',
            'Caffè Navigli',
            'La Bottega Lombarda',
            'Ristorante Corso Buenos Aires',
            'Ristorante Parco Sempione',
            'Trattoria Centrale',
            'Lombardia Gourmet',
            'Antica Trattoria Milano',
            'Ristorante della Scala',
            'Pasticceria Navigli',
            'Ristorante Castello',
            'Il Sapore di Milano',
            'La Brera Antica',
            'Ristorante Milano Est',
            'Cucina Navigli',
            'Taverna Naviglio',
            'Caffè Milano Centrale',
            'Il Naviglio Gourmet',
            'Ristorante Porta Nuova',
            'Osteria Centrale',
            'Ristorante Milano Ovest',
            'Il Gusto Lombardo',
            'La Milano Antica',
            'Sapori Navigli',
            'Farmacia Alcolica'
        ];

        // Definisco un array di indirizzi di ristoranti realistici a Milano
        $restaurantAddresses = [
            'Via Monte Napoleone, 8, 20121 Milano MI',
            'Corso Buenos Aires, 33, 20124 Milano MI',
            'Via della Moscova, 29, 20121 Milano MI',
            'Via Solari, 11, 20144 Milano MI',
            'Via Savona, 97, 20144 Milano MI',
            'Corso Magenta, 65, 20123 Milano MI',
            'Via Paolo Sarpi, 62, 20154 Milano MI',
            'Via Dante, 15, 20123 Milano MI',
            'Piazza San Babila, 3, 20122 Milano MI',
            'Via Torino, 45, 20123 Milano MI',
            'Corso Como, 10, 20154 Milano MI',
            'Via Manzoni, 12, 20121 Milano MI',
            'Via Brera, 28, 20121 Milano MI',
            'Piazza Gae Aulenti, 4, 20154 Milano MI',
            'Via della Spiga, 30, 20121 Milano MI',
            'Via Vittor Pisani, 16, 20124 Milano MI',
            'Corso Venezia, 15, 20121 Milano MI',
            'Via Monte Grappa, 2, 20124 Milano MI',
            "Via Sant'Andrea, 22, 20121 Milano MI",
            'Piazza Cordusio, 7, 20123 Milano MI',
            'Via Durini, 24, 20122 Milano MI',
            'Via Pergolesi, 8, 20124 Milano MI',
            'Via Larga, 6, 20122 Milano MI',
            'Via Vittorio Veneto, 15, 20124 Milano MI',
            'Via Palestro, 20, 20121 Milano MI',
            'Via Filodrammatici, 2, 20121 Milano MI',
            'Via Albricci, 8, 20122 Milano MI',
            'Corso Vercelli, 37, 20144 Milano MI',
            'Via Melchiorre Gioia, 132, 20125 Milano MI',
            'Via Fabio Filzi, 25, 20124 Milano MI',
            'Via De Amicis, 17, 20123 Milano MI',
            'Via Torino, 35, 20123 Milano MI',
            'Piazza XXIV Maggio, 1, 20123 Milano MI',
            'Via Bergognone, 34, 20144 Milano MI',
            'Via Arco, 7, 20121 Milano MI',
            'Via Pantano, 12, 20122 Milano MI',
            'Via Carducci, 39, 20123 Milano MI',
            'Via Boccaccio, 16, 20123 Milano MI',
            'Piazza Cinque Giornate, 6, 20129 Milano MI',
            'Piazza Gae Aulenti, 34, 20154 Milano MI',
            'Via della Spiga, 77, 20121 Milano MI',
        ];

        // Definisco un array di numeri di telefono realistici di Milano
        $restaurantPhones = [
            '02 12345678',
            '02 87654321',
            '02 11223344',
            '02 44332211',
            '02 99887766',
            '02 66778899',
            '02 55667788',
            '02 77889900',
            '02 44556677',
            '02 33445566',
            '02 99001122',
            '02 22334455',
            '02 55664433',
            '02 77886655',
            '02 66779988',
            '02 12344321',
            '02 87653210',
            '02 11224433',
            '02 44557766',
            '02 99883322',
            '02 66774488',
            '02 55668899',
            '02 77885599',
            '02 44556688',
            '02 33447788',
            '02 99002233',
            '02 22336644',
            '02 55663344',
            '02 77889922',
            '02 66771122',
            '02 12345432',
            '02 87651234',
            '02 11223355',
            '02 44558877',
            '02 99881122',
            '02 66775588',
            '02 55662233',
            '02 77881155',
            '02 44553366',
            '02 33446655'
        ];

        // Itera sugli utenti e crea un ristorante per ciascuno di loro
        foreach ($users as $index => $user) {

            $restaurant = new Restaurant();

            // Assegna l'utente al ristorante
            $restaurant->user_id = $user->id;

            // Dati del ristorante
            $restaurant->name = $restaurantNames[$index];
            $restaurant->address = $restaurantAddresses[$index];
            $restaurant->city = 'Milano';
            $restaurant->phone_number = $restaurantPhones[$index % count($restaurantPhones)];
            $restaurant->piva = $faker->numerify('###########');
            $restaurant->slug = Str::slug($restaurant->name);

            // Salva il ristorante nel database
            $restaurant->save();
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
