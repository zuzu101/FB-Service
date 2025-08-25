<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('device_repairs', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->nullable()->after('status')->comment('Estimasi biaya service');
            $table->date('complete_in')->nullable()->after('price')->comment('Perkiraan tanggal selesai service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_repairs', function (Blueprint $table) {
            $table->dropColumn(['price', 'complete_in']);
        });
    }
};
