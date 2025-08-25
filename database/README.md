# Database Seeding Guide

## Available Seeders

### 1. QuickTestSeeder
- **Purpose**: Minimal test data for quick testing
- **Data Created**:
  - 2 customers
  - 5 device repairs with different statuses
- **Usage**: `php artisan db:seed --class=QuickTestSeeder`

### 2. EssentialDataSeeder
- **Purpose**: Essential data for development
- **Data Created**:
  - 5 realistic customers
  - 20 device repair records from last month
- **Usage**: `php artisan db:seed --class=EssentialDataSeeder`

### 3. DatabaseSeeder (Main)
- **Purpose**: Complete database setup
- **Includes**:
  - AdminUserSeeder (Admin user)
  - EssentialDataSeeder (Customer data)
- **Usage**: `php artisan db:seed`

## Quick Commands

```bash
# Fresh migration + full seed
php artisan migrate:fresh --seed

# Seed only essential data
php artisan db:seed --class=EssentialDataSeeder

# Seed quick test data
php artisan db:seed --class=QuickTestSeeder

# Seed everything (admin + essential)
php artisan db:seed
```

## Batch Script
Run `seed-database.bat` for interactive menu to choose seeding options.

## Data Structure

### Admin User
- Email: admin@admin.com
- Password: password

### Sample Customers
- Ahmad Rizki (ahmad.rizki@example.com)
- Siti Nurhaliza (siti.nurhaliza@example.com)
- Budi Santoso (budi.santoso@example.com)
- Diana Sari (diana.sari@example.com)
- Eko Prasetyo (eko.prasetyo@example.com)

### Device Repairs
- Various brands: iPhone, Samsung, Xiaomi, Oppo
- Different statuses: Perangkat Baru Masuk, Sedang Diperbaiki, Selesai, Siap Diambil
- Realistic pricing based on brand and issue
- Sample nota numbers and serial numbers

## Migration Status
All migrations are now compatible and run smoothly:
- ✅ Base tables (users, device_repairs, etc.)
- ✅ customers table
- ✅ customer_id foreign key in device_repairs
- ❌ Removed problematic pelanggan migrations
