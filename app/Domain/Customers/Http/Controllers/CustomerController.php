<?php

namespace App\Domain\Customers\Http\Controllers;

use App\Domain\Customers\Models\Customer;
use App\Domain\Customers\Services\CustomerDomainService;
use App\Domain\Customers\Services\ICustomerDomainService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $_customerDomainService;
    public function __construct(ICustomerDomainService $customrDomainService) {
        $this->_customerDomainService = $customrDomainService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->_customerDomainService->GetAll();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = $request->all();
        return $this->_customerDomainService->Create($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $customer = $request->all();
        return $this->_customerDomainService->Update($customer,$id);
    }

    public function delete($id)
    {
        return $this->_customerDomainService->Delete($id);
    }
}
