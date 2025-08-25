<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms\Customers;
use App\Models\Cms\DeviceRepair;
use Carbon\Carbon;

class FullYearDeviceRepairWithCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip seeding if customers already exist (instead of device repairs)
        if (Customers::count() > 0) {
            echo "Customers already exist. Skipping seeder.\n";
            return;
        }

        // Create customers first
        $customers = [
            ['name' => 'Ahmad Rizki', 'email' => 'ahmad.rizki@email.com', 'phone' => '081234567890', 'address' => 'Jl. Sudirman No. 123, Jakarta'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti.nur@email.com', 'phone' => '081234567891', 'address' => 'Jl. Thamrin No. 456, Jakarta'],
            ['name' => 'Budi Santoso', 'email' => 'budi.santoso@email.com', 'phone' => '081234567892', 'address' => 'Jl. Gatot Subroto No. 789, Jakarta'],
            ['name' => 'Diana Sari', 'email' => 'diana.sari@email.com', 'phone' => '081234567893', 'address' => 'Jl. Kuningan No. 101, Jakarta'],
            ['name' => 'Eko Prasetyo', 'email' => 'eko.prasetyo@email.com', 'phone' => '081234567894', 'address' => 'Jl. Senayan No. 202, Jakarta'],
            ['name' => 'Fitri Handayani', 'email' => 'fitri.handayani@email.com', 'phone' => '081234567895', 'address' => 'Jl. Menteng No. 303, Jakarta'],
            ['name' => 'Gilang Ramadhan', 'email' => 'gilang.ramadhan@email.com', 'phone' => '081234567896', 'address' => 'Jl. Kemang No. 404, Jakarta'],
            ['name' => 'Hana Permata', 'email' => 'hana.permata@email.com', 'phone' => '081234567897', 'address' => 'Jl. Pondok Indah No. 505, Jakarta'],
            ['name' => 'Indra Wijaya', 'email' => 'indra.wijaya@email.com', 'phone' => '081234567898', 'address' => 'Jl. Blok M No. 606, Jakarta'],
            ['name' => 'Joko Widodo', 'email' => 'joko.widodo@email.com', 'phone' => '081234567899', 'address' => 'Jl. Pancoran No. 707, Jakarta'],
            ['name' => 'Kartika Dewi', 'email' => 'kartika.dewi@email.com', 'phone' => '081234567800', 'address' => 'Jl. Tebet No. 808, Jakarta'],
            ['name' => 'Lukman Hakim', 'email' => 'lukman.hakim@email.com', 'phone' => '081234567801', 'address' => 'Jl. Cikini No. 909, Jakarta'],
            ['name' => 'Maya Sari', 'email' => 'maya.sari@email.com', 'phone' => '081234567802', 'address' => 'Jl. Salemba No. 110, Jakarta'],
            ['name' => 'Nanda Pratama', 'email' => 'nanda.pratama@email.com', 'phone' => '081234567803', 'address' => 'Jl. Matraman No. 111, Jakarta'],
            ['name' => 'Oka Suryana', 'email' => 'oka.suryana@email.com', 'phone' => '081234567804', 'address' => 'Jl. Pramuka No. 112, Jakarta'],
        ];

        $customerIds = [];
        foreach ($customers as $customer) {
            // Check if customer already exists by email
            $existingCustomer = Customers::where('email', $customer['email'])->first();
            if ($existingCustomer) {
                $customerIds[] = $existingCustomer->id;
            } else {
                $newCustomer = Customers::create($customer);
                $customerIds[] = $newCustomer->id;
            }
        }

        // Device brands and models
        $devices = [
            ['brand' => 'iPhone', 'models' => ['iPhone 12', 'iPhone 13', 'iPhone 14', 'iPhone 15', 'iPhone 11']],
            ['brand' => 'Samsung', 'models' => ['Galaxy S23', 'Galaxy S22', 'Galaxy A54', 'Galaxy A34', 'Galaxy Note 20']],
            ['brand' => 'Xiaomi', 'models' => ['Redmi Note 12', 'Redmi Note 11', 'Xiaomi 13', 'Xiaomi 12', 'POCO X5']],
            ['brand' => 'Oppo', 'models' => ['Reno 8', 'Reno 7', 'A77', 'A57', 'Find X5']],
            ['brand' => 'Vivo', 'models' => ['V27', 'V25', 'Y35', 'Y22', 'X80']],
            ['brand' => 'Realme', 'models' => ['Realme 10', 'Realme 9', 'C55', 'C35', 'GT Neo 3']],
            ['brand' => 'Huawei', 'models' => ['P50', 'P40', 'Nova 10', 'Nova 9', 'Mate 50']],
        ];

        // Common issues
        $issues = [
            'Layar pecah/retak',
            'Baterai cepat habis',
            'Tidak bisa charge',
            'Mati total',
            'Hang/lemot',
            'Kamera tidak berfungsi',
            'Speaker tidak keluar suara',
            'Tombol power rusak',
            'Touchscreen tidak responsive',
            'Overheating',
            'Aplikasi force close',
            'Signal lemah',
            'Mikrofon tidak berfungsi',
            'Port charging rusak',
            'LCD bergaris/berubah warna',
            'Fingerprint tidak bekerja',
            'Face ID/unlock tidak berfungsi',
            'Memory penuh',
            'Bootloop',
            'Water damage'
        ];

        $statuses = ['Perangkat Baru Masuk', 'Sedang Diperbaiki', 'Selesai'];
        
        // Generate data for full year (from August 2024 to August 2025)
        $startDate = Carbon::create(2024, 8, 1);
        $endDate = Carbon::create(2025, 8, 20);
        
        // Start note number from 5000 to avoid conflicts with existing data
        $noteNumber = 5000;
        $currentDate = $startDate->copy();
        
        while ($currentDate->lte($endDate)) {
            // Generate random number of services per day (1-8 services)
            $servicesPerDay = rand(1, 8);
            
            for ($i = 0; $i < $servicesPerDay; $i++) {
                $device = $devices[array_rand($devices)];
                $brand = $device['brand'];
                $model = $device['models'][array_rand($device['models'])];
                $issue = $issues[array_rand($issues)];
                $customerId = $customerIds[array_rand($customerIds)];
                
                // Random service time within the day
                $serviceTime = $currentDate->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59));
                
                // Determine status based on date (older services more likely to be completed)
                $daysDiff = $serviceTime->diffInDays(now());
                if ($daysDiff > 30) {
                    $status = $statuses[2]; // Selesai
                } elseif ($daysDiff > 7) {
                    $status = $statuses[rand(1, 2)]; // Sedang Diperbaiki or Selesai
                } else {
                    $status = $statuses[rand(0, 2)]; // Random
                }
                
                // Price based on brand and issue type
                $basePrice = match($brand) {
                    'iPhone' => rand(200000, 2000000),
                    'Samsung' => rand(150000, 1500000),
                    'Xiaomi' => rand(100000, 800000),
                    'Oppo' => rand(120000, 900000),
                    'Vivo' => rand(110000, 850000),
                    'Realme' => rand(90000, 700000),
                    'Huawei' => rand(130000, 1000000),
                    default => rand(100000, 500000)
                };
                
                // Adjust price based on issue
                if (str_contains(strtolower($issue), 'layar') || str_contains(strtolower($issue), 'lcd')) {
                    $basePrice = $basePrice * rand(15, 25) / 10;
                } elseif (str_contains(strtolower($issue), 'water') || str_contains(strtolower($issue), 'mati total')) {
                    $basePrice = $basePrice * rand(20, 30) / 10;
                }
                
                $price = round($basePrice, -3); // Round to nearest thousand
                
                // Complete date for completed services
                $completeDate = null;
                if ($status === 'Selesai') {
                    $completeDate = $serviceTime->copy()->addDays(rand(1, 14));
                }
                
                // Generate nota number with "CUST" prefix to differentiate
                $notaMonth = $serviceTime->format('Ym');
                $formattedNoteNumber = str_pad($noteNumber, 3, '0', STR_PAD_LEFT);
                $notaNumber = "CUST-{$notaMonth}-{$formattedNoteNumber}";
                
                // Random technician notes
                $techNotes = [
                    'Sudah dicek, perlu ganti sparepart',
                    'Perlu pemesanan komponen khusus',
                    'Sudah diperbaiki dan ditest normal',
                    'Menunggu konfirmasi dari customers',
                    'Sedang proses perbaikan',
                    'Komponen sudah diganti, sedang testing',
                    'Perlu waktu tambahan untuk analisa',
                    'Sudah selesai, siap diambil'
                ];
                
                DeviceRepair::create([
                    'nota_number' => $notaNumber,
                    'customer_id' => $customerId, // Changed from pelanggan_id to customer_id
                    'brand' => $brand,
                    'model' => $model,
                    'reported_issue' => $issue,
                    'serial_number' => strtoupper(substr(md5($notaNumber . $brand), 0, 8)),
                    'technician_note' => $techNotes[array_rand($techNotes)],
                    'status' => $status,
                    'price' => $price,
                    'complete_in' => $completeDate,
                    'created_at' => $serviceTime,
                    'updated_at' => $serviceTime,
                ]);
                
                $noteNumber++;
                
                // Add some random delay between services
                $serviceTime->addMinutes(rand(15, 120));
            }
            
            // Move to next day
            $currentDate->addDay();
            
            // Skip some random days (business closure, holidays, etc.)
            if (rand(1, 10) == 1) {
                $currentDate->addDays(rand(1, 3));
            }
        }
        
        echo "Seeder completed! Generated " . ($noteNumber - 1) . " device repair records for full year.\n";
    }
}
