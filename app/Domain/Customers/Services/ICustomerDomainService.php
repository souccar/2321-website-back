<?php

namespace App\Domain\Customers\Services;

use App\Domain\Customers\Models\Customer;

interface ICustomerDomainService
{
    function GetAll();
    function GetById($id);
    function Create($customer);
    function Update($customer,$id);
    function Delete($id);
}
