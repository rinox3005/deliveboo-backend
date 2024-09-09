<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = new User();
        $user->name = 'Mario Rossi';
        $user->email = 'owner1@test.com';
        $user->password = Hash::make('password');
        $user->remember_token = Str::random(10);
        $user->email_verified_at = now();
        $user->save();

        $user = new User();
        $user->name = 'Luca Bianchi';
        $user->email = 'owner2@test.com';
        $user->password = Hash::make('password');
        $user->remember_token = Str::random(10);
        $user->email_verified_at = now();
        $user->save();
    }
}
