<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Order::truncate();

        $user_names = [
            "Laura Moretti",
            "Sofia Lombardi",
            "Valentina Greco",
            "Sara De Luca",
            "Valentina Gallo",
            "Alessandro Barbieri",
            "Alice Leone",
            "Francesco Bianchi",
            "Valentina Leone",
            "Marco De Luca",
            "Alessandro Romano",
            "Alessandro Barbieri",
            "Valentina Bruno",
            "Alice Gallo",
            "Simone De Luca",
            "Valentina Santoro",
            "Elena Romano",
            "Sara De Luca",
            "Simone Fontana",
            "Federico De Luca"
        ];

        $emails = [
            "laura.moretti@hotmail.com",
            "sofia.lombardi@hotmail.com",
            "valentina.greco@gmail.com",
            "sara.de@hotmail.com",
            "valentina.gallo@gmail.com",
            "alessandro.barbieri@outlook.com",
            "alice.leone@outlook.com",
            "francesco.bianchi@gmail.com",
            "valentina.leone@yahoo.com",
            "marco.de@libero.it",
            "alessandro.romano@yahoo.com",
            "alessandro.barbieri@gmail.com",
            "valentina.bruno@gmail.com",
            "alice.gallo@gmail.com",
            "simone.de@hotmail.com",
            "valentina.santoro@libero.it",
            "elena.romano@gmail.com",
            "sara.de@gmail.com",
            "simone.fontana@gmail.com",
            "federico.de@gmail.com"
        ];

        $addresses = [
            "Piazza Dante, 7, 40100 Verona",
            "Via Leopardi, 33, 43100 Perugia",
            "Via Marconi, 37, 43100 Milano",
            "Via Garibaldi, 27, 50100 Genova",
            "Viale dei Mille, 51, 00100 Verona",
            "Via Leopardi, 74, 34100 Perugia",
            "Via Mazzini, 71, 24100 Reggio Emilia",
            "Via Roma, 42, 34100 Padova",
            "Viale Europa, 91, 80100 Perugia",
            "Via Verdi, 3, 41100 Pisa",
            "Via Matteotti, 70, 10100 Modena",
            "Piazza della Repubblica, 60, 37100 Trieste",
            "Piazza Duomo, 44, 10100 Bergamo",
            "Via Roma, 6, 95100 Parma",
            "Via Manzoni, 40, 50100 Napoli",
            "Via Giotto, 84, 43100 Bergamo",
            "Via Mazzini, 93, 00100 Padova",
            "Via Garibaldi, 66, 40100 Bologna",
            "Corso Italia, 25, 41100 Bergamo",
            "Via Roma, 23, 10100 Torino"
        ];

        $phoneNumber = [
            "+39 354258784",
            "+39 332613596",
            "+39 338349485",
            "+39 355239327",
            "+39 331119557",
            "+39 357502822",
            "+39 368639094",
            "+39 357504983",
            "+39 353094470",
            "+39 368331981",
            "+39 397811705",
            "+39 363536287",
            "+39 382237959",
            "+39 361927719",
            "+39 321114550",
            "+39 372783448",
            "+39 354185453",
            "+39 327541249",
            "+39 399812764",
            "+39 349736789"
        ];

        $notes = [
            "Per favore senza cipolla nel panino, sono allergico.",
            "Mi raccomando, niente latticini nella pasta, grazie.",
            "Vorrei il condimento a parte per l'insalata.",
            "Potete aggiungere una bustina di ketchup extra?",
            "Per favore non mettete piccante, grazie!",
            "Potete sostituire il pane con quello integrale?",
            "Non citofonate, ho il cane che abbaia, lasciate l'ordine fuori.",
            "Vorrei la pizza ben cotta, per favore.",
            "Se possibile, raddoppiate le patatine, grazie!",
            "Niente posate, cerco di evitare plastica, grazie.",
            "Lasciate l'ordine al portone, grazie!",
            "Potete tagliare la pizza in spicchi piccoli, per favore?",
            "Vorrei le bevande ben fredde, grazie.",
            "Preferirei il panino senza maionese, grazie!",
            "Per favore, hamburger senza pomodoro, sono intollerante.",
            "Fate attenzione alle allergie: niente frutta secca, grazie.",
            "Vorrei la pasta ben al dente, non troppo cotta.",
            "Per favore, consegnate dopo le 20:00, grazie.",
            "Non citofonate, lasciate tutto nella cassetta.",
            "Potete mettere più verdure nel wrap? Grazie!"
        ];

        // Crea un'istanza di Faker per generare dati casuali
        $faker = Faker::create();

        // Creo 20 ordini casuali
        for ($i = 0; $i < count($user_names); $i++) {

            $order = new Order();

            // Associo l'ordine a un ristorante casuale
            $order->restaurant_id = Restaurant::inRandomOrder()->first()->id;

            // Dati utente casuali
            $order->user_name = $user_names[$i];
            $order->user_email = $emails[$i];
            $order->user_address = $addresses[$i];
            $order->user_phone = $phoneNumber[$i];

            // Data e ora dell'ordine
            $order->order_date_time = $faker->dateTimeThisYear();
            $order->delivery_date = $faker->date();
            $order->delivery_time = $faker->time();

            // Prezzo totale casuale e slug
            $order->total_price = $faker->randomFloat(2, 10, 50);
            $order->notes = $faker->randomElement($notes);

            // Assegna uno slug temporaneo prima del primo salvataggio
            $order->slug = 'temp-slug';

            // Salva l'ordine nel database
            $order->save();

            // Genera lo slug utilizzando "NO" + ID dell'ordine
            $order->slug = 'NO' . $order->id;

            // Salva l'ordine nel database dopo aver creato lo slug
            $order->save();
        }

        Schema::enableForeignKeyConstraints();
    }
}
