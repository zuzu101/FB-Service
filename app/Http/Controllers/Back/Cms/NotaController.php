<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Models\Cms\DeviceRepair;
use App\Services\Cms\NotaService;
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
        return view('back.cms.Nota.index');
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
        
        return view('back.cms.Nota.print', compact('deviceRepair', 'notaNumber'));
    }

    /**
     * Generate PDF nota
     */
    public function pdf($id)
    {
        $deviceRepair = $this->notaService->getNotaData($id);
        $notaNumber = $this->notaService->generateNotaNumber($deviceRepair);
        
        $pdf = Pdf::loadView('back.cms.Nota.pdf', compact('deviceRepair', 'notaNumber'));
        $pdf->setPaper('a5', 'portrait');
        
        return $pdf->download($notaNumber . '.pdf');
    }
}
