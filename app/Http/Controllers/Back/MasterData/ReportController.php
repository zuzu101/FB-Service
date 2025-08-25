<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Services\MasterData\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    protected $reportService;
    
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display main report dashboard
     */
    public function index()
    {
        return view('back.MasterData.Report.index');
    }

    /**
     * Daily service report
     */
    public function daily(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));
        return view('back.MasterData.Report.daily', compact('date'));
    }

    /**
     * Weekly service report
     */
    public function weekly(Request $request)
    {
        $week = $request->get('week', now()->format('Y-W'));
        return view('back.MasterData.Report.weekly', compact('week'));
    }

    /**
     * Monthly service report
     */
    public function monthly(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        return view('back.MasterData.Report.monthly', compact('month'));
    }

    /**
     * Brand report
     */
    public function brand()
    {
        $brands = $this->reportService->getAvailableBrands();
        return view('back.MasterData.Report.brand', compact('brands'));
    }

    /**
     * Issue type report
     */
    public function issue()
    {
        return view('back.MasterData.Report.issue');
    }

    /**
     * Transaction history report
     */
    public function history()
    {
        return view('back.MasterData.Report.history');
    }

    /**
     * Get daily report data
     */
    public function dailyData(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));
        return $this->reportService->getDailyReport($date);
    }

    /**
     * Get weekly report data
     */
    public function weeklyData(Request $request)
    {
        $week = $request->get('week', now()->format('Y-W'));
        
        // Debug log
        Log::info('Weekly report week parameter: ' . $week);
        
        try {
            return $this->reportService->getWeeklyReport($week);
        } catch (\Exception $e) {
            Log::error('Weekly report error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get monthly report data
     */
    public function monthlyData(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        return $this->reportService->getMonthlyReport($month);
    }

    /**
     * Get brand report data
     */
    public function brandData(Request $request)
    {
        return $this->reportService->getBrandReport($request);
    }

    /**

     * Get transaction history data
     */
    public function historyData(Request $request)
    {
        return $this->reportService->getTransactionHistory($request);
    }

    /**
     * Get transaction history summary
     */
    public function historySummary(Request $request)
    {
        return response()->json($this->reportService->getTransactionHistorySummary($request));
    }

    /**
     * Export report to PDF
     */
    public function exportPdf(Request $request)
    {
        $type = $request->get('type'); // daily, weekly, monthly, brand, issue
        $date = $request->get('date');
        
        return $this->reportService->exportToPdf($type, $date);
    }

    /**
     * Export report to Excel
     */
    public function exportExcel(Request $request)
    {
        $type = $request->get('type'); // daily, weekly, monthly, brand, issue
        $date = $request->get('date');
        
        return $this->reportService->exportToExcel($type, $date);
    }
}
