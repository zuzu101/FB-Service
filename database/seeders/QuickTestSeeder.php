<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms\Customers;
use App\Models\Cms\DeviceRepair;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuickTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates minimal test data for quick testing
     */
    public function run(): void
    {
        $this->command->info('Creating quick test data...');
        
        // Create just 2 customers for quick testing
        $customers = [
            [
                'name' => 'Test Customer 1',
                'email' => 'test1@example.com',
                'phone' => '081234567890',
                'address' => 'Test Address 1',
                'status' => 1
            ],
            [
                'name' => 'Test Customer 2',
                'email' => 'test2@example.com',
                'phone' => '081234567891',
                'address' => 'Test Address 2',
                'status' => 1
            ]
        ];

        $customerIds = [];
        foreach ($customers as $customerData) {
            $customer = Customers::create($customerData);
            $customerIds[] = $customer->id;
        }
        
        // Create just 5 device repairs
        $repairs = [
            [
                'nota_number' => 'NOTA-TEST-001',
                'customer_id' => $customerIds[0],
                'brand' => 'iPhone',
                'model' => 'iPhone 13',
                'reported_issue' => 'Layar pecah',
                'serial_number' => 'TEST001',
                'technician_note' => 'Test repair 1',
                'status' => 'Perangkat Baru Masuk',
                'price' => 500000,
                'complete_in' => null,
            ],
            [
                'nota_number' => 'NOTA-TEST-002',
                'customer_id' => $customerIds[1],
                'brand' => 'Samsung',
                'model' => 'Galaxy S23',
                'reported_issue' => 'Baterai rusak',
                'serial_number' => 'TEST002',
                'technician_note' => 'Test repair 2',
                'status' => 'Sedang Diperbaiki',
                'price' => 300000,
                'complete_in' => null,
            ],
            [
                'nota_number' => 'NOTA-TEST-003',
                'customer_id' => $customerIds[0],
                'brand' => 'Xiaomi',
                'model' => 'Redmi Note 12',
                'reported_issue' => 'Touchscreen error',
                'serial_number' => 'TEST003',
                'technician_note' => 'Test repair 3',
                'status' => 'Selesai',
                'price' => 200000,
                'complete_in' => Carbon::now()->subDays(2),
            ],
            [
                'nota_number' => 'NOTA-TEST-004',
                'customer_id' => $customerIds[1],
                'brand' => 'Oppo',
                'model' => 'Reno 8',
                'reported_issue' => 'Charging port rusak',
                'serial_number' => 'TEST004',
                'technician_note' => 'Test repair 4',
                'status' => 'Siap Diambil',
                'price' => 150000,
                'complete_in' => Carbon::now()->subDays(1),
            ],
            [
                'nota_number' => 'NOTA-TEST-005',
                'customer_id' => $customerIds[0],
                'brand' => 'Vivo',
                'model' => 'V27',
                'reported_issue' => 'Speaker tidak bunyi',
                'serial_number' => 'TEST005',
                'technician_note' => 'Test repair 5',
                'status' => 'Menunggu Spare Part',
                'price' => 100000,
                'complete_in' => null,
            ]
        ];
        
        foreach ($repairs as $repairData) {
            DeviceRepair::create($repairData);
        }
        
        $this->command->info('Quick test data created!');
        $this->command->info('- 2 customers');
        $this->command->info('- 5 device repairs with different statuses');
    }
}
