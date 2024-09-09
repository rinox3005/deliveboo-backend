<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type; // Importa il modello Type
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disabilito i vincoli delle chiavi esterne per evitare problemi durante il truncate
        Schema::disableForeignKeyConstraints();

        // Svuoto la tabella prima di inserire nuovi record
        Type::truncate();

        // Definisco un array di tipi di ristoranti
        $types = [
            'Italiano',
            'Giapponese',
            'Coreano',
            'Cinese',
            'Messicano',
            'Indiano',
            'Vegetariano',
            'Vegano',
            'Greco',
            'Americano',
            'Mediterraneo',
            'Francese',
            'Turco',
            'Argentino',
        ];

        // Creo nuovi record per ciascun tipo di ristorante
        foreach ($types as $type) {

            $new_type = new Type();

            $new_type->name = $type;
            $new_type->slug = Str::of($type)->slug();

            $new_type->save();
        }

        // Riabilito i vincoli delle chiavi esterne
        Schema::enableForeignKeyConstraints();
    }
}
