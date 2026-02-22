<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use App\Filters\V1\CustomersFilter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): CustomerCollection
    {
        $filter = new CustomersFilter();
        $filterItems = $filter->transform(request: $request); // [["column", "operator", "value"]]

        $includeInvoices = $request->query(key: "includeInvoices");

        $customers = Customer::where(column: $filterItems);

        if ($includeInvoices) {
            $customers = $customers->with(relations: "invoices");
        }

        return new CustomerCollection(resource: $customers->paginate()->appends(key: $request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): CustomerResource
    {
        return new CustomerResource(resource: Customer::create(attributes: $request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer, Request $request): CustomerResource
    {
        $includeInvoices = $request->query(key: "includeInvoices");
        if ($includeInvoices) {
            return new CustomerResource(resource: $customer->loadMissing(relations: "invoices"));
        }
        return new CustomerResource(resource: $customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): void
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
