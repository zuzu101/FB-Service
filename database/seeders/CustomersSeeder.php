<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms\Customers;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates sample customers only
     */
    public function run(): void
    {
        // Create sample customers
        $customers = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@example.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta',
                'status' => 1
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'phone' => '081234567891',
                'address' => 'Jl. Thamrin No. 456, Jakarta',
                'status' => 1
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 789, Jakarta',
                'status' => 1
            ],
            [
                'name' => 'Diana Sari',
                'email' => 'diana.sari@example.com',
                'phone' => '081234567893',
                'address' => 'Jl. Kuningan No. 101, Jakarta',
                'status' => 1
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@example.com',
                'phone' => '081234567894',
                'address' => 'Jl. Senayan No. 202, Jakarta',
                'status' => 1
            ]
        ];

        foreach ($customers as $customerData) {
            // Check if customer already exists by email
            if (!Customers::where('email', $customerData['email'])->exists()) {
                Customers::create($customerData);
            }
        }

        $this->command->info('CustomersSeeder completed - 5 customers created!');
    }
}
