<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Models\Cms\DeviceRepair;
use Yajra\DataTables\Facades\DataTables;

class NotaService
{
    protected $imageHelper;
    public function __construct() {
        $this->imageHelper = new ImageHelpers('back_assets/img/cms/Nota/');
    }

    public function data(object $deviceRepair)
    {
        $array = $deviceRepair->with('customers')->orderBy('id', 'desc')->get(['id', 'nota_number', 'customer_id', 'brand', 'model', 'reported_issue', 'serial_number', 'technician_note', 'status', 'price', 'complete_in', 'created_at']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['nota_number'] = $item->nota_number ?: '-';
            $nestedData['pelanggan_name'] = $item->customers ? $item->customers->name : 'No Customers';
            $nestedData['device_info'] = $item->brand . ' ' . $item->model;
            $nestedData['reported_issue'] = $item->reported_issue;
            
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
            
            $nestedData['price_formatted'] = $item->price ? 'Rp ' . number_format($item->price, 0, ',', '.') : '-';
            $nestedData['created_date'] = $item->created_at ? $item->created_at->format('d/m/Y') : '-';
            $nestedData['complete_date'] = $item->complete_in ? $item->complete_in->format('d/m/Y') : '-';
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.cms.Nota.print', $item->id) . '" class="btn btn-outline-info btn-sm" target="_blank"><i class="fa fa-print"></i> Print</a>
                    <a href="' . route('admin.cms.Nota.pdf', $item->id) . '" class="btn btn-outline-danger btn-sm" target="_blank"><i class="fa fa-file-pdf"></i> PDF</a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "status"])->toJson();
    }

    public function getNotaData($id)
    {
        return DeviceRepair::with('customers')->findOrFail($id);
    }

    public function generateNotaNumber($deviceRepair)
    {
        // Ambil dari database, jika tidak ada generate otomatis
        return $deviceRepair->nota_number ?: 'NOTA-' . date('Ym', strtotime($deviceRepair->created_at)) . '-' . str_pad($deviceRepair->id, 3, '0', STR_PAD_LEFT);
    }
}
