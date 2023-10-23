<?php

namespace App\Domain\Customers\Services;

use App\Domain\Customers\Models\Customer;

class CustomerDomainService implements ICustomerDomainService
{
    public function GetAll(){
        return Customer::all();
    }
    public function GetById($id){
        return Customer::find($id)->get();
    }
    public function Create($customer){
        return Customer::create($customer);
    }
    public function Update($customer,$id){
        $original = Customer::find($id);
        $original->update($customer);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = Customer::find($id);
        $original->delete();
    }

}
