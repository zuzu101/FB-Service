<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\DeviceRepair;
use App\Services\MasterData\NotaService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaController extends Controller
{
    protected $notaService;
    
    public function __construct(NotaService $notaService)
    {
        $this->notaService = $notaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.MasterData.Nota.index');
    }

    /**
     * Get data for DataTables
     */
    public function data(DeviceRepair $deviceRepair)
    {
        return $this->notaService->data($deviceRepair);
    }

    /**
     * Print nota (thermal print view)
     */
    public function print($id)
    {
        $deviceRepair = $this->notaService->getNotaData($id);
        $notaNumber = $this->notaService->generateNotaNumber($deviceRepair);
        
        return view('back.MasterData.Nota.print', compact('deviceRepair', 'notaNumber'));
    }

    /**
     * Generate PDF nota
     */
    public function pdf($id)
    {
        $deviceRepair = $this->notaService->getNotaData($id);
        $notaNumber = $this->notaService->generateNotaNumber($deviceRepair);
        
        $pdf = Pdf::loadView('back.MasterData.Nota.pdf', compact('deviceRepair', 'notaNumber'));
        $pdf->setPaper('a5', 'portrait');
        
        return $pdf->download($notaNumber . '.pdf');
    }
}
