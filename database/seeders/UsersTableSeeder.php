<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito i vincoli delle chiavi esterne per evitare problemi durante il truncate
        Schema::disableForeignKeyConstraints();

        // Svuoto la tabella prima di inserire nuovi record
        User::truncate();

        // Array di nomi italiani comuni
        $italianFirstNames = [
            'Mario',
            'Luigi',
            'Giovanni',
            'Francesco',
            'Marco',
            'Luca',
            'Matteo',
            'Alessandro',
            'Andrea',
            'Antonio',
            'Giorgio',
            'Roberto',
            'Stefano',
            'Paolo',
            'Gabriele',
            'Pietro',
            'Simone',
            'Riccardo',
            'Davide',
            'Daniele',
            'Carlo',
            'Giuseppe',
            'Michele',
            'Fabio',
            'Vincenzo',
            'Filippo',
            'Enrico',
            'Emanuele',
            'Alberto',
            'Claudio',
            'Leonardo',
            'Sergio',
            'Nicola',
            'Valentino',
            'Federico',
            'Massimo',
            'Giulio',
            'Fabrizio',
            'Cristiano',
            'Lorenzo'
        ];

        // Array di cognomi italiani comuni
        $italianLastNames = [
            'Rossi',
            'Ferrari',
            'Russo',
            'Bianchi',
            'Romano',
            'Gallo',
            'Costa',
            'Fontana',
            'Conti',
            'Esposito',
            'Ricci',
            'Bruno',
            'Greco',
            'De Luca',
            'Mancini',
            'Lombardi',
            'Barbieri',
            'Moretti',
            'Mariani',
            'Rizzo',
            'Giordano',
            'Colombo',
            'Martini',
            'Leone',
            'Longo',
            'Sanna',
            'Gatti',
            'Serra',
            'Ferri',
            'Bianco',
            'Marini',
            'Cattaneo',
            'Grassi',
            'Pellegrini',
            'Palumbo',
            'Rinaldi',
            'Battaglia',
            'Amato',
            'Monti',
            'Donati',
            'Santoro'
        ];

        for ($i = 1; $i <= 40; $i++) {
            $user = new User();
            // Genera un nome e un cognome casuali
            $user->name = $italianFirstNames[array_rand($italianFirstNames)] . ' ' . $italianLastNames[array_rand($italianLastNames)];
            $user->email = 'owner' . $i . '@test.com';
            $user->password = Hash::make('password');
            $user->remember_token = Str::random(10);
            $user->email_verified_at = now();
            $user->save();
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
