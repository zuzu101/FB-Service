<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\CustomersRequest;
use App\Models\Cms\Customers;
use App\Services\Cms\CustomersService;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    protected $customersService;
    public function __construct(CustomersService $customersService)
    {
        $this->customersService = $customersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.cms.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.cms.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomersRequest $customersRequest)
    {
        $this->customersService->store($customersRequest);

        return redirect()->route('admin.cms.customers.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customer)
    {
        return view('back.cms.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomersRequest $customersRequest, Customers $customer)
    {
        $this->customersService->update($customersRequest, $customer);

        return redirect()->route('admin.cms.customers.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customer)
    {
        $this->customersService->destroy($customer);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Customers $customer)
    {
        return $this->customersService->data($customer);
    }

    //function to update customers status
    public function updateCustomersStatus(Request $request, Customers $customer)
    {
        $customer->update(['status' => $request->status]);

        return response()->json(['message' => "Status berhasil diperbarui"], 200);
    }
}
