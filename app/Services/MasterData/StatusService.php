<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\MasterData\StatusRequest;
use App\Models\MasterData\Status;
use Yajra\DataTables\Facades\DataTables;

class StatusService
{
    protected $imageHelper;
    public function __construct() {
        $this->imageHelper = new ImageHelpers('back_assets/img/MasterData/Status/');
    }

    public function store(StatusRequest $request) {
        $request->validated();

        try {
            Status::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(StatusRequest $request, Status $status)
    {
        $request->validated();

        try {
            $status->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Status $status) {
        try {
            $status->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $status, $request = null)
    {
        $query = $status->with('customers')->orderBy('id', 'desc');
        
        // Apply status filter if provided
        if ($request && $request->has('status_filter') && $request->status_filter != '') {
            $query->where('status', $request->status_filter);
        }
        
        $array = $query->get(['id', 'customer_id', 'brand', 'model', 'reported_issue', 'serial_number', 'technician_note', 'status']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['pelanggan_name'] = $item->customers ? $item->customers->name : 'No Customers';
            $nestedData['brand'] = $item->brand;
            $nestedData['model'] = $item->model;
            $nestedData['reported_issue'] = $item->reported_issue;
            $nestedData['serial_number'] = $item->serial_number;
            $nestedData['technician_note'] = $item->technician_note ?: '-';
            
            $currentStatus = $item->status ?: 'Perangkat Baru Masuk';
            
            // Add colored status badge
            $statusClass = '';
            switch($currentStatus) {
                case 'Selesai':
                    $statusClass = 'badge bg-success';
                    break;
                case 'Sedang Diperbaiki':
                    $statusClass = 'badge bg-warning';
                    break;
                case 'Perangkat Baru Masuk':
                    $statusClass = 'badge bg-secondary';
                    break;
                default:
                    $statusClass = 'badge bg-secondary';
            }
            $nestedData['status'] = '<span class="' . $statusClass . '">' . $currentStatus . '</span>';
            
            // tombol status
            $actionButton = '';
            if ($currentStatus == 'Perangkat Baru Masuk') {
                $actionButton = '<div class="text-center">
                    <a href="javascript:void(0)" onclick="updateStatus(' . $item->id . ', \'Sedang Diperbaiki\')" class="btn btn-outline-warning btn-sm" title="Mulai Perbaikan">
                        <i class="fa fa-cog"></i>
                    </a>
                </div>';
            } elseif ($currentStatus == 'Sedang Diperbaiki') {
                $actionButton = '<div class="text-center">
                    <a href="javascript:void(0)" onclick="updateStatus(' . $item->id . ', \'Selesai\')" class="btn btn-outline-success btn-sm" title="Selesaikan">
                        <i class="fa fa-check"></i>
                    </a>
                </div>';
            } elseif ($currentStatus == 'Selesai') {
                $actionButton = '<div class="text-center">
                    <a href="' . route('admin.MasterData.Status.preview', $item->id) . '" class="btn btn-outline-info btn-sm" title="Preview Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>';
            }
            
            $nestedData['actions'] = $actionButton;

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "status"])->toJson();
    }
}
