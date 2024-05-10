<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Http\Requests\StoreOperationRequest;
use App\Http\Requests\UpdateOperationRequest;
use App\Models\Estimate;
use App\Models\LocationOfWork;
use App\Models\Material;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Estimate $estimate, LocationOfWork $location_of_work): View
    {
        $materials = Material::join('prices', 'materials.id', '=', 'prices.material_id')
            ->where('prices.mode_of_work_id', '=', $estimate->mode_of_work_id)
            ->select('materials.id', 'materials.name', 'prices.unit_price', 'prices.workforce_price')
            ->get();

        return view('operation.create', [
            'estimate' => $estimate,
            'location_of_work' => $location_of_work,
            'materials' => $materials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Estimate $estimate, LocationOfWork $location_of_work): RedirectResponse
    {
        foreach($request->except(['_token', 'subtotal', 'supplies', 'warranty']) as $value)
        {
            $ids = explode("_", $value);

            if(count($location_of_work->operations) > 0 ){
                foreach($location_of_work->operations as $ope){
                    $ope->delete();
                }
            }
            $operation = new Operation();
            $operation->location_of_work_id = $location_of_work->id;
            $operation->material_id = (int) $ids[0];
            $operation->quantity = (int) $ids[1];
            $operation->save();
        }
        
        $location_of_work->subtotal = $request->subtotal;
        $location_of_work->supplies = $request->supplies;
        
        $location_of_work->warranty = $request->warranty;
        $location_of_work->save();

        $message = 'Travaux dans "' . ucfirst(strtolower($location_of_work->room->name)) .'" ajouté au devis de ' . ucfirst(strtolower($estimate->customer->firstname)) .' '. strtoupper($estimate->customer->lastname) . '. Cliquez en haut à droite si vous avez terminé, sinon choisissez une nouvelle pièce pour poursuivre le devis.';

        $request->session()->flash('success', $message);

        return redirect()->route('location_of_work.edit', ['estimate' => $estimate,
                                                            'location_of_work' => $location_of_work]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Operation $operation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operation $operation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOperationRequest $request, Operation $operation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operation $operation)
    {
        //
    }
}
