<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::orderBy("created_at", "desc")->get();

        return response()->json([
            'success'   => true,
            'message'   => "success",
            "data" => $customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $customerid)
    {
        $data = $request->validated();
        $customer = Customer::find($customerid);
        $customer->first_name = $data["first_name"];
        $customer->last_name = $data["last_name"];
        $customer->save();

        return response()->json([
            'success'   => true,
            'message'   => "success",
            "data" => $customer
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::destroy($id);

        return response()->json([
            'success'   => true,
            'message'   => "success",
        ]);
    }
}
