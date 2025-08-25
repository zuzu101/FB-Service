<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\Cms\DeviceRepairRequest;
use App\Models\Cms\DeviceRepair;
use Yajra\DataTables\Facades\DataTables;

class DeviceRepairService
{
    protected $imageHelper;
    public function __construct() {
        $this->imageHelper = new ImageHelpers('back_assets/img/cms/DeviceRepair/');
    }

    public function store(DeviceRepairRequest $request) {
        $request->validated();

        try {
            DeviceRepair::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(DeviceRepairRequest $request, DeviceRepair $deviceRepair)
    {
        $request->validated();

        try {
            $deviceRepair->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(DeviceRepair $deviceRepair) {
        try {
            $deviceRepair->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $deviceRepair)
    {
        $array = $deviceRepair->with('customers')->orderBy('id', 'desc')->get(['id', 'customer_id', 'brand', 'model', 'reported_issue', 'serial_number', 'technician_note', 'status', 'price', 'complete_in']);

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
            
            // Add colored status badge
            $currentStatus = $item->status ?: 'Perangkat Baru Masuk';
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
                case 'Menunggu Spare Part':
                    $statusClass = 'badge bg-secondary';
                    break;
                case 'Siap Diambil':
                    $statusClass = 'badge bg-primary';
                    break;
                case 'Sudah Diambil':
                    $statusClass = 'badge bg-dark';
                    break;
                default:
                    $statusClass = 'badge bg-secondary';
            }
            $nestedData['status'] = '<span class="' . $statusClass . '">' . $currentStatus . '</span>';
            
            $nestedData['price'] = $item->price ? 'Rp ' . number_format($item->price, 0, ',', '.') : '-';
            $nestedData['complete_in'] = $item->complete_in ? $item->complete_in->format('d/m/Y') : '-';
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.cms.DeviceRepair.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" onclick="deleteDeviceRepair(' . $item->id . ')" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "status"])->toJson();
    }
}
