<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\StatusRequest;
use App\Models\Cms\Status;
use App\Services\Cms\StatusService;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusService;
    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.cms.Status.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.cms.Status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $statusRequest)
    {
        $this->statusService->store($statusRequest);

        return redirect()->route('admin.cms.Status.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('back.cms.Status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $statusRequest, Status $status)
    {
        $this->statusService->update($statusRequest, $status);

        return redirect()->route('admin.cms.Status.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $this->statusService->destroy($status);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Status $status, Request $request)
    {
        return $this->statusService->data($status, $request);
    }
    public function updateStatus(Request $request, Status $status)
    {
        $status->update(['status' => $request->status]);

        return response()->json(['message' => "Status berhasil diperbarui"], 200);
    }

    public function preview(Status $status)
    {
        $status->load('customers');
        return view('back.cms.Status.preview', compact('status'));
    }
}
