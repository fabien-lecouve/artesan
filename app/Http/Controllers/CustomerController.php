<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customers = Customer::whereHas('estimates', function($query) {
                                    $query->where('user_id', Auth::id());
                                })->orderBy('lastname')
                                ->filter(request(['search_customer']))
                                ->get();

        return view('customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        Customer::create($request->all());

        $request->session()->flash('success', 'Le client ' . ucfirst(strtolower($request->firstname)) .' '. strtoupper($request->lastname) .' a bien été créé');

        return redirect()->route('customer.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {
        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->fill($request->all());
        $customer->save();

        $request->session()->flash('success', 'Le client ' . ucfirst(strtolower($customer->firstname)) .' '. strtoupper($customer->lastname) .' a bien été modifié');

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
