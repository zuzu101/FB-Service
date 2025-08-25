<?php

namespace App\Observers;

use App\Models\Cms\DeviceRepair;

class DeviceRepairObserver
{
    /**
     * Handle the DeviceRepair "created" event.
     */
    public function created(DeviceRepair $deviceRepair): void
    {
        // Generate nomor nota setelah data dibuat
        $notaNumber = 'NOTA-' . date('Ym', strtotime($deviceRepair->created_at)) . '-' . str_pad($deviceRepair->id, 3, '0', STR_PAD_LEFT);
        
        // Update nota_number tanpa trigger observer lagi
        $deviceRepair->updateQuietly(['nota_number' => $notaNumber]);
    }
}
