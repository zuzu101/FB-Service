<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterData\DeviceRepair;
use App\Models\MasterData\Customers;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DeviceRepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Indonesian locale
        
        // Data laptop dan brand populer di Indonesia
        $laptopBrands = [
            'ASUS', 'Acer', 'HP', 'Lenovo', 'Dell', 'MSI', 'Toshiba', 
            'Sony', 'Samsung', 'Apple', 'Xiaomi', 'Huawei'
        ];
        
        $laptopModels = [
            'VivoBook', 'ZenBook', 'ROG Strix', 'TUF Gaming', 'Aspire', 'Swift',
            'Nitro', 'Predator', 'Pavilion', 'EliteBook', 'Envy', 'Omen',
            'ThinkPad', 'IdeaPad', 'Legion', 'Yoga', 'Inspiron', 'XPS',
            'Latitude', 'Vostro', 'Katana', 'Stealth', 'Creator', 'Prestige',
            'Satellite', 'Tecra', 'VAIO', 'Galaxy Book', 'MacBook', 'RedmiBook'
        ];
        
        // Masalah umum laptop dalam bahasa Indonesia
        $commonIssues = [
            'Laptop mati total tidak bisa menyala',
            'Layar blank hitam tapi power nyala', 
            'Keyboard tidak berfungsi sebagian tombol',
            'Touchpad tidak responsif',
            'Baterai cepat habis tidak bisa charge',
            'Kipas berisik dan panas berlebihan',
            'WiFi tidak bisa connect',
            'Bluetooth tidak terdeteksi',
            'Audio tidak keluar suara',
            'Webcam tidak berfungsi',
            'Port USB rusak tidak terdeteksi',
            'Charger tidak mengisi baterai',
            'Layar bergaris atau flickering',
            'Hard disk error tidak bisa booting',
            'RAM error blue screen',
            'Motherboard korsleting',
            'Engsel layar patah',
            'Spill cairan pada keyboard',
            'Virus dan malware berat',
            'Windows corrupt tidak bisa masuk',
            'Overheat sering hang dan restart',
            'Speaker crackling suara pecah',
            'CD/DVD ROM tidak terbaca',
            'Lag dan lemot saat digunakan',
            'Install ulang Windows dan software'
        ];
        
        $statusOptions = [
            'Perangkat Baru Masuk',
            'Sedang Diperbaiki', 
            'Selesai'
        ];
        
        // Catatan teknisi dalam bahasa Indonesia
        $technicianNotes = [
            'Perlu ganti thermal paste dan pembersihan internal',
            'RAM sudah diganti dengan yang baru',
            'Hard disk diganti dengan SSD baru',
            'Keyboard sudah dibersihkan dan diperbaiki',
            'Motherboard perlu penggantian komponen',
            'Baterai original sudah diganti',
            'Install ulang Windows 11 dan driver lengkap',
            'Perbaikan engsel layar sudah selesai',
            'Pembersihan virus dan optimasi sistem',
            'Ganti kipas processor yang rusak',
            'Perbaikan jalur charging pada motherboard',
            'Update BIOS dan driver terbaru',
            'Penggantian layar LCD yang retak',
            'Perbaikan port USB yang longgar',
            'Cleaning dan re-apply thermal compound'
        ];
        
        // Get all customer IDs
        $customerIds = Customers::pluck('id')->toArray();
        
        if (empty($customerIds)) {
            $this->command->warn('Tidak ada data customers. Jalankan CustomersSeeder terlebih dahulu.');
            return;
        }
        
        // Generate device repair data untuk 1 tahun kebelakang
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();
        
        for ($i = 1; $i <= 200; $i++) {
            $randomDate = Carbon::createFromTimestamp(
                rand($startDate->timestamp, $endDate->timestamp)
            );
            
            $brand = $faker->randomElement($laptopBrands);
            $model = $faker->randomElement($laptopModels);
            $status = $faker->randomElement($statusOptions);
            
            // Generate price berdasarkan status
            $price = null;
            $completeDate = null;
            
            if ($status === 'Selesai') {
                $price = $faker->numberBetween(50000, 2000000); // 50rb - 2jt
                $completeDate = $randomDate->copy()->addDays($faker->numberBetween(1, 14));
            }
            
            DeviceRepair::create([
                'customer_id' => $faker->randomElement($customerIds),
                'brand' => $brand,
                'model' => $model . ' ' . $faker->numberBetween(100, 9999),
                'reported_issue' => $faker->randomElement($commonIssues),
                'serial_number' => strtoupper($faker->lexify('??')) . $faker->numerify('######'),
                'technician_note' => $faker->boolean(70) ? $faker->randomElement($technicianNotes) : null,
                'status' => $status,
                'price' => $price,
                'complete_in' => $completeDate,
                'created_at' => $randomDate,
                'updated_at' => $randomDate->copy()->addHours($faker->numberBetween(1, 48))
            ]);
        }
        
        $this->command->info('Berhasil membuat 200 data device repair dengan data Indonesia');
    }
}
