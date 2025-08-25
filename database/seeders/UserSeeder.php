<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if superadmin user already exists
        if (!User::where('email', 'superadmin@mail.com')->exists()) {
            User::create([
                'name'      => 'superadmin',
                'email'     => 'superadmin@mail.com',
                'password'  => Hash::make('SecretDev123!')
            ]);
        }
    }
}
