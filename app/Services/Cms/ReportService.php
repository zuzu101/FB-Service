<?php

namespace App\Services\Cms;

use App\Models\Cms\DeviceRepair;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Get daily service report
     */
    public function getDailyReport($date)
    {
        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        $services = DeviceRepair::with('customers')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $data = [];
        $no = 0;
        $totalServices = 0;
        $completedServices = 0;
        $totalRevenue = 0;

        foreach ($services as $item) {
            $nestedData['no'] = ++$no;
            $nestedData['nota'] = $item->nota_number ?: '-';
            $nestedData['pelanggan'] = $item->customers ? $item->customers->name : 'No Customers';
            $nestedData['brand'] = $item->brand ?: '-';
            $nestedData['model'] = $item->model ?: '-';
            $nestedData['issue'] = $item->reported_issue ?: '-';
            $nestedData['status'] = $item->status ?: 'Perangkat Baru Masuk';
            $nestedData['price'] = $item->price ? 'Rp ' . number_format((float)$item->price, 0, ',', '.') : '-';
            $nestedData['created_at'] = $item->created_at->format('d/m/Y H:i');

            $totalServices++;
            if ($item->status === 'Selesai') {
                $completedServices++;
            }
            if ($item->price) {
                $totalRevenue += (float)$item->price;
            }

            $data[] = $nestedData;
        }

        $summary = [
            'total_services' => $totalServices,
            'completed_services' => $completedServices,
            'pending_services' => $totalServices - $completedServices,
            'total_revenue' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
            'date' => Carbon::parse($date)->format('d F Y')
        ];

        return DataTables::of($data)
            ->with('summary', $summary)
            ->rawColumns(['actions'])
            ->toJson();
    }

    /**
     * Get weekly service report
     */
    public function getWeeklyReport($week)
    {
        try {
            // Parse week format (e.g., "2025-W33")
            if (strpos($week, '-W') !== false) {
                $year = substr($week, 0, 4);
                $weekNum = substr($week, 6);
            } else {
                // Fallback to current week if format is invalid
                $year = date('Y');
                $weekNum = date('W');
            }
            
            $startDate = Carbon::now()->setISODate($year, $weekNum)->startOfWeek();
            $endDate = Carbon::now()->setISODate($year, $weekNum)->endOfWeek();

            $services = DeviceRepair::with('customers')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();

            // Group by day
            $dailyData = [];
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $dayServices = $services->filter(function ($service) use ($date) {
                    return $service->created_at->format('Y-m-d') === $date->format('Y-m-d');
                });

                $dailyRevenue = $dayServices->sum(function ($service) {
                    return (float)$service->price ?: 0;
                });

                $dailyData[] = [
                    'date' => $date->format('d/m/Y'),
                    'raw_date' => $date->format('Y-m-d'), // Raw date for URL parameter
                    'day' => $date->format('l'),
                    'total_services' => $dayServices->count(),
                    'completed' => $dayServices->where('status', 'Selesai')->count(),
                    'revenue' => 'Rp ' . number_format($dailyRevenue, 0, ',', '.')
                ];
            }

            $summary = [
                'total_services' => $services->count(),
                'completed_services' => $services->where('status', 'Selesai')->count(),
                'total_revenue' => 'Rp ' . number_format($services->sum(function ($service) {
                    return (float)$service->price ?: 0;
                }), 0, ',', '.'),
                'week_period' => $startDate->format('d M') . ' - ' . $endDate->format('d M Y')
            ];

            return response()->json([
                'data' => $dailyData,
                'summary' => $summary
            ]);
                
        } catch (\Exception $e) {
            // Return empty data with error info for debugging
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'week_input' => $week
            ], 500);
        }
    }

    /**
     * Get monthly service report
     */
    public function getMonthlyReport($month)
    {
        $startDate = Carbon::parse($month . '-01')->startOfMonth();
        $endDate = Carbon::parse($month . '-01')->endOfMonth();

        $services = DeviceRepair::with('customers')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Group by week
        $weeklyData = [];
        $currentWeekStart = $startDate->copy()->startOfWeek();
        
        while ($currentWeekStart->lte($endDate)) {
            $currentWeekEnd = $currentWeekStart->copy()->endOfWeek();
            if ($currentWeekEnd->gt($endDate)) {
                $currentWeekEnd = $endDate->copy();
            }

            $weekServices = $services->filter(function ($service) use ($currentWeekStart, $currentWeekEnd) {
                return $service->created_at->between($currentWeekStart, $currentWeekEnd);
            });

            $weeklyRevenue = $weekServices->sum(function ($service) {
                return (float)$service->price ?: 0;
            });

            // Generate week identifier for URL parameter (YYYY-WNN format)
            $weekYear = $currentWeekStart->year;
            $weekNumber = $currentWeekStart->weekOfYear;
            $weekIdentifier = $weekYear . '-W' . str_pad($weekNumber, 2, '0', STR_PAD_LEFT);

            $weeklyData[] = [
                'week_period' => $currentWeekStart->format('d/m') . ' - ' . $currentWeekEnd->format('d/m/Y'),
                'week_identifier' => $weekIdentifier, // For URL parameter
                'total_services' => $weekServices->count(),
                'completed' => $weekServices->where('status', 'Selesai')->count(),
                'revenue' => 'Rp ' . number_format($weeklyRevenue, 0, ',', '.')
            ];

            $currentWeekStart->addWeek();
        }

        $summary = [
            'total_services' => $services->count(),
            'completed_services' => $services->where('status', 'Selesai')->count(),
            'total_revenue' => 'Rp ' . number_format($services->sum(function ($service) {
                return (float)$service->price ?: 0;
            }), 0, ',', '.'),
            'month_period' => $startDate->format('F Y')
        ];

        return DataTables::of($weeklyData)
            ->addColumn('action', function($data) {
                return '<a href="' . route('admin.cms.Report.weekly') . '?week=' . $data['week_identifier'] . '&from_monthly=1" class="btn btn-primary btn-sm">
                           <i class="fas fa-eye"></i> Lihat Detail
                        </a>';
            })
            ->with('summary', $summary)
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Get brand report with optional filter
     */
    public function getBrandReport($request = null)
    {
        $query = DeviceRepair::select('brand', 
                DB::raw('COUNT(*) as total_services'),
                DB::raw('SUM(CASE WHEN status = "Selesai" THEN 1 ELSE 0 END) as completed'),
                DB::raw('SUM(CASE WHEN price IS NOT NULL THEN price ELSE 0 END) as total_revenue'))
            ->groupBy('brand')
            ->orderBy('total_services', 'desc');

        // Apply brand filter if provided
        if ($request && $request->has('brand_filter') && $request->brand_filter != '') {
            $query->where('brand', $request->brand_filter);
        }

        $brandStats = $query->get();

        $data = [];
        $no = 0;
        foreach ($brandStats as $brand) {
            $nestedData['no'] = ++$no;
            $nestedData['brand'] = $brand->brand ?: 'Unknown';
            $nestedData['total_services'] = $brand->total_services;
            $nestedData['completed'] = $brand->completed;
            $nestedData['pending'] = $brand->total_services - $brand->completed;
            $nestedData['completion_rate'] = $brand->total_services > 0 
                ? round(($brand->completed / $brand->total_services) * 100, 1) . '%' 
                : '0%';
            $nestedData['revenue'] = 'Rp ' . number_format((float)$brand->total_revenue, 0, ',', '.');

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(['actions'])->toJson();
    }

    /**
     * Get available brands for filter
     */
    public function getAvailableBrands()
    {
        return DeviceRepair::select('brand')
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');
    }

    /**
     * Get transaction history report (all service transactions)
     */
    public function getTransactionHistory($request)
    {
        $query = DeviceRepair::with('customers')->orderBy('id', 'desc');

        // Apply filters
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand', 'LIKE', '%' . $request->brand . '%');
        }

        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return DataTables::eloquent($query)
            ->addColumn('no', function($data) {
                static $counter = 0;
                $counter++;
                return $counter;
            })
            ->addColumn('nota_number', function($data) {
                return $data->nota_number ?: '-';
            })
            ->addColumn('created_date', function($data) {
                return $data->created_at->format('d/m/Y H:i');
            })
            ->addColumn('pelanggan', function($data) {
                return $data->customers ? $data->customers->name : 'No Customers';
            })
            ->addColumn('phone', function($data) {
                return $data->customers ? $data->customers->phone : '-';
            })
            ->addColumn('email', function($data) {
                return $data->customers ? $data->customers->email : '-';
            })
            ->addColumn('brand', function($data) {
                return $data->brand ?: '-';
            })
            ->addColumn('model', function($data) {
                return $data->model ?: '-';
            })
            ->addColumn('serial_number', function($data) {
                return $data->serial_number ?: '-';
            })
            ->addColumn('reported_issue', function($data) {
                return $data->reported_issue ?: '-';
            })
            ->addColumn('technician_note', function($data) {
                return $data->technician_note ?: '-';
            })
            ->addColumn('status', function($data) {
                $statusClass = '';
                switch($data->status) {
                    case 'Selesai':
                        $statusClass = 'badge bg-success';
                        break;
                    case 'Sedang Diperbaiki':
                        $statusClass = 'badge bg-warning';
                        break;
                    default:
                        $statusClass = 'badge bg-secondary';
                }
                return '<span class="' . $statusClass . '">' . ($data->status ?: 'Perangkat Baru Masuk') . '</span>';
            })
            ->addColumn('price', function($data) {
                return $data->price ? 'Rp ' . number_format((float)$data->price, 0, ',', '.') : '-';
            })
            ->addColumn('complete_in', function($data) {
                return $data->complete_in ? \Carbon\Carbon::parse($data->complete_in)->format('d/m/Y') : '-';
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    /**
     * Get transaction history summary for dashboard cards
     */
    public function getTransactionHistorySummary($request)
    {
        $query = DeviceRepair::query();

        // Apply same filters as main data
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand', 'LIKE', '%' . $request->brand . '%');
        }

        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $services = $query->get();
        $totalCompleted = $services->where('status', 'Selesai')->count();
        $totalRevenue = $services->sum('price');

        return [
            'total_transactions' => $services->count(),
            'completed_transactions' => $totalCompleted,
            'pending_transactions' => $services->count() - $totalCompleted,
            'total_revenue' => 'Rp ' . number_format($totalRevenue, 0, ',', '.')
        ];
    }

    /**
     * Export to PDF (placeholder - requires DomPDF)
     */
    public function exportToPdf($type, $date)
    {
        // Implementation would require DomPDF package
        return response()->json(['message' => 'PDF export feature coming soon']);
    }

    /**
     * Export to Excel (placeholder - requires Laravel Excel)
     */
    public function exportToExcel($type, $date)
    {
        // Implementation would require Laravel Excel package
        return response()->json(['message' => 'Excel export feature coming soon']);
    }
}
