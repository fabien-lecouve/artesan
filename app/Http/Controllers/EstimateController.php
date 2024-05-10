<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Http\Requests\Estimates\StoreEstimateRequest;
use App\Http\Requests\Estimates\UpdateEstimateRequest;
use App\Models\Customer;
use App\Models\ModeOfWork;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $estimates = Estimate::with('customer')
                                ->filter(request(['search_customer', 'search_status']))
                                ->where('user_id', Auth::id())
                                ->orderBy('created_at', 'DESC')
                                ->get();

        return view('estimate.index', ['estimates' => $estimates, 'statuses' => Status::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('estimate.create', [
            'customers' => Customer::orderBy('lastname')->get(),
            'modes' => ModeOfWork::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstimateRequest $request): RedirectResponse
    {
        $estimate = new Estimate();
        $estimate->user_id = Auth::id();

        if($request->filled('checkbox_customer')) {
            $customer = new Customer();
            $customer->lastname = $request->input('lastname');
            $customer->firstname = $request->input('firstname');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->postal_code = $request->input('postal_code');
            $customer->city = $request->input('city');
            $customer->save();

            $estimate->customer_id = $customer->id;
        } else {
            $estimate->customer_id = $request->customer_id;
        }

        $estimate->mode_of_work_id = $request->mode_of_work_id;
        $estimate->titled = $request->titled;
        $estimate->big_construction = $request->filled('big_construction') ? true : false;
        $estimate->status_id = 1;
        $estimate->save();

        return redirect()->route('location_of_work.create', ['estimate' => $estimate]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimate $estimate): View
    {
        return view('estimate.show', ['estimate' => $estimate]);
    }

    public function getEstimatePdf(Estimate $estimate)
    {
        return PDF::loadView('estimate.estimate_pdf', ['estimate' => $estimate])
                    ->download('Devis_'.$estimate->reference.'.pdf'); 
    }

    public function getInvoicePdf(Estimate $estimate)
    {
        return PDF::loadView('estimate.invoice_pdf', ['estimate' => $estimate])
                    ->download('Facture_'.$estimate->reference.'.pdf'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estimate $estimate): View
    {
        return view('estimate.edit', [
            'estimate' => $estimate,
            'statuses' => Status::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstimateRequest $request, Estimate $estimate): RedirectResponse
    {
        $estimate->reference = $request->reference;
        if($request->filled('status_id')) {
            $estimate->status_id = $request->status_id;
        }
        $estimate->advance = $request->advance;
        $estimate->total = $request->total;
        $estimate->save();

        return redirect()->route('estimate.show', ['estimate' => $estimate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimate $estimate): RedirectResponse
    {
        try {
            DB::beginTransaction();

            foreach($estimate->locationOfWorks as $location){
                foreach($location->operations as $operation){
                    $operation->delete();
                }
                foreach($location->descriptions as $description){
                    $description->delete();
                }
                $location->delete();
            }
            $estimate->delete();

            DB::commit();

            $key = 'success';
            $message = 'Le devis '.$estimate->reference.' a bien été supprimé';

        } catch (\Throwable $th) {
            DB::rollBack();

            $key = 'failed';
            $message = $th->getMessage();
        }
        return redirect()->route('estimate.index')->with($key, $message);
    }
}
