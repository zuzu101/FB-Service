<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ServiceOrderRequest;
use App\Models\MasterData\Customers;
use App\Models\MasterData\DeviceRepair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceOrderController extends Controller
{
    /**
     * Store service order from front-end form
     *
     * @param  ServiceOrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ServiceOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create or find customer
            $customer = Customers::where('email', $request->email)->first();
            
            if (!$customer) {
                $customer = Customers::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'status' => 1, // Active by default
                ]);
            } else {
                // Update customer data if exists
                $customer->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
            }

            // Generate nota number
            $latestNota = DeviceRepair::latest('id')->first();
            $nextNumber = $latestNota ? $latestNota->id + 1 : 1;
            $notaNumber = 'NOTA-' . date('Ym') . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // Create device repair record
            DeviceRepair::create([
                'nota_number' => $notaNumber,
                'customer_id' => $customer->id,
                'brand' => $request->brand,
                'model' => $request->model,
                'serial_number' => $request->serial_number,
                'reported_issue' => $request->reported_issue,
                'technician_note' => '-',
                'status' => 'Perangkat Baru Masuk',
                'price' => null,
                'complete_in' => null,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Permintaan service berhasil dikirim! Kami akan segera menghubungi Anda.',
                'nota_number' => $notaNumber
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi atau hubungi customer service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
