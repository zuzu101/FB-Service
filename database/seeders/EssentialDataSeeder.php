<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms\Customers;
use App\Models\Cms\DeviceRepair;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EssentialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder only creates essential data needed for development/testing
     */
    public function run(): void
    {
        // Clear existing data (optional - remove if you want to keep existing data)
        $this->command->info('Clearing existing data...');
        DB::table('device_repairs')->delete();
        DB::table('customers')->delete();
        
        // Create essential customers (just 5 for testing)
        $this->command->info('Creating essential customers...');
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

        $customerIds = [];
        foreach ($customers as $customerData) {
            $customer = Customers::create($customerData);
            $customerIds[] = $customer->id;
        }
        
        // Create sample device repairs (just 20 records for testing)
        $this->command->info('Creating sample device repairs...');
        
        $devices = [
            ['brand' => 'iPhone', 'models' => ['iPhone 13', 'iPhone 14', 'iPhone 15']],
            ['brand' => 'Samsung', 'models' => ['Galaxy S23', 'Galaxy A54']],
            ['brand' => 'Xiaomi', 'models' => ['Redmi Note 12', 'Xiaomi 13']],
            ['brand' => 'Oppo', 'models' => ['Reno 8', 'A77']],
        ];

        $issues = [
            'Layar pecah/retak',
            'Baterai cepat habis',
            'Tidak bisa charge',
            'Mati total',
            'Touchscreen tidak responsive'
        ];

        $statuses = [
            'Perangkat Baru Masuk',
            'Sedang Diperbaiki', 
            'Selesai',
            'Siap Diambil'
        ];
        
        // Create device repairs for the last month
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();
        
        for ($i = 1; $i <= 20; $i++) {
            $device = $devices[array_rand($devices)];
            $brand = $device['brand'];
            $model = $device['models'][array_rand($device['models'])];
            $issue = $issues[array_rand($issues)];
            $customerId = $customerIds[array_rand($customerIds)];
            $status = $statuses[array_rand($statuses)];
            
            // Random date within last month
            $serviceDate = Carbon::createFromTimestamp(
                rand($startDate->timestamp, $endDate->timestamp)
            );
            
            // Generate simple nota number with timestamp to avoid conflicts
            $notaNumber = 'NOTA-ESS-' . $serviceDate->format('mdHi') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
            
            // Price based on brand
            $price = match($brand) {
                'iPhone' => rand(300000, 1500000),
                'Samsung' => rand(200000, 1000000),
                'Xiaomi' => rand(150000, 600000),
                'Oppo' => rand(180000, 700000),
                default => rand(100000, 500000)
            };
            
            // Complete date if status is completed
            $completeDate = null;
            if (in_array($status, ['Selesai', 'Siap Diambil'])) {
                $completeDate = $serviceDate->copy()->addDays(rand(1, 7));
            }
            
            DeviceRepair::create([
                'nota_number' => $notaNumber,
                'customer_id' => $customerId,
                'brand' => $brand,
                'model' => $model,
                'reported_issue' => $issue,
                'serial_number' => strtoupper(substr(md5($notaNumber), 0, 8)),
                'technician_note' => 'Sample technician note for testing',
                'status' => $status,
                'price' => $price,
                'complete_in' => $completeDate,
                'created_at' => $serviceDate,
                'updated_at' => $serviceDate,
            ]);
        }
        
        $this->command->info('Essential data seeding completed!');
        $this->command->info('Created:');
        $this->command->info('- 5 customers');
        $this->command->info('- 20 device repair records');
    }
}
