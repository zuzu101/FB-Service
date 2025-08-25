<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\DeviceRepairRequest;
use App\Models\MasterData\DeviceRepair;
use App\Services\MasterData\DeviceRepairService;
use Illuminate\Http\Request;

class DeviceRepairController extends Controller
{
    protected $deviceRepairService;
    public function __construct(DeviceRepairService $deviceRepairService)
    {
        $this->deviceRepairService = $deviceRepairService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.MasterData.DeviceRepair.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.MasterData.DeviceRepair.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRepairRequest $deviceRepairRequest)
    {
        $this->deviceRepairService->store($deviceRepairRequest);

        return redirect()->route('admin.MasterData.DeviceRepair.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceRepair $deviceRepair)
    {
        return view('back.MasterData.DeviceRepair.edit', compact('deviceRepair'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeviceRepairRequest $deviceRepairRequest, DeviceRepair $deviceRepair)
    {
        $this->deviceRepairService->update($deviceRepairRequest, $deviceRepair);

        return redirect()->route('admin.MasterData.DeviceRepair.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceRepair $deviceRepair)
    {
        $this->deviceRepairService->destroy($deviceRepair);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(DeviceRepair $deviceRepair)
    {
        return $this->deviceRepairService->data($deviceRepair);
    }

    //function to update device repair status
    public function updateDeviceRepairStatus(Request $request, DeviceRepair $deviceRepair)
    {
        $deviceRepair->update(['status' => $request->status]);

        return response()->json(['message' => "Status berhasil diperbarui"], 200);
    }
}
