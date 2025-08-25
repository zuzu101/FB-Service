<?php

namespace App\Observers;

use App\Models\MasterData\DeviceRepair;
use Illuminate\Support\Facades\Log;

class DeviceRepairObserver
{
    /**
     * Handle the DeviceRepair "created" event.
     */
    public function created(DeviceRepair $deviceRepair): void
    {
        // Debug log untuk memastikan observer dipanggil
        Log::info('DeviceRepairObserver::created called for ID: ' . $deviceRepair->id);
        
        // Generate nomor nota setelah data dibuat
        $notaNumber = 'NOTA-' . date('Ym', strtotime($deviceRepair->created_at)) . '-' . str_pad($deviceRepair->id, 3, '0', STR_PAD_LEFT);
        
        Log::info('Generated nota number: ' . $notaNumber);
        
        // Update nota_number tanpa trigger observer lagi
        $deviceRepair->updateQuietly(['nota_number' => $notaNumber]);
        
        Log::info('Nota number updated successfully');
    }
}
