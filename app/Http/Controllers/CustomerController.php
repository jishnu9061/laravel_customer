<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/06/25
 * Time: 19:57:35
 * Description: CustomerController.php
 */

namespace App\Http\Controllers;

use App\Http\Helpers\ToastrHelper;

use App\Models\Customer;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function index(Request $request)
    {
        $query = Customer::select('id', 'name', 'address', 'email', 'status', 'company', 'phone');
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        $customers = $query->get();
        return view('pages.customers.index', compact('customers'));
    }

    /**
     * @return [type]
     */
    public function create()
    {
        return view('pages.customers.create');
    }

    /**
     * @param CustomerStoreRequest $request
     *
     * @return [type]
     */
    public function store(CustomerStoreRequest $request)
    {
        Customer::create([
            'name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status
        ]);
        ToastrHelper::success('Customer added successfully');
        return redirect()->route('home');
    }

    /**
     * @param Customer $customer
     *
     * @return [type]
     */
    public function edit(Customer $customer)
    {
        return view('pages.customers.edit', compact('customer'));
    }

    /**
     * @param CustomerUpdateRequest $request
     * @param Customer $customer
     *
     * @return [type]
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->update([
            'name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status
        ]);
        ToastrHelper::success('Customer updated successfully');
        return redirect()->route('home');
    }

    /**
     * @param Customer $customer
     *
     * @return [type]
     */
    public function toggleStatus(Customer $customer)
    {
        $customer->status = !$customer->status;
        $customer->save();
        return response()->json(['success' => 'Customer status updated successfully.']);
    }

    /**
     * @param Customer $customer
     *
     * @return [type]
     */
    public function delete(Customer $customer)
    {
        $customer->delete();
        ToastrHelper::success('Customer deleted successfully');
    }
}
