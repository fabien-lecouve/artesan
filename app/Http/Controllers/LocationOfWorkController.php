<?php

namespace App\Http\Controllers;

use App\Models\LocationOfWork;
use App\Http\Requests\LocationofWorks\StoreLocationOfWorkRequest;
use App\Http\Requests\LocationofWorks\UpdateLocationOfWorkRequest;
use App\Models\DescriptionLocation;
use App\Models\Estimate;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LocationOfWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Estimate $estimate): View
    {
        return view('location_of_work.index', ['estimate' => $estimate]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Estimate $estimate): View
    {
        return view('location_of_work.create', [
            'estimate' => $estimate,
            'rooms' => Room::select('id', 'name')->orderBy('name')->get(),]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationOfWorkRequest $request, Estimate $estimate): RedirectResponse
    {
        $locationOfWork = null;

        if(count($estimate->locationOfWorks) > 0)
        {
            foreach($estimate->locationOfWorks as $location)
            {
                if($location->room->id == $request->room_id)
                {
                    $locationOfWork = $location;
                }
            }
        }
        if (!$locationOfWork) {
            $locationOfWork = new LocationOfWork();
            $locationOfWork->estimate_id = $estimate->id;
            $locationOfWork->room_id = $request->room_id;
            $locationOfWork->warranty = 2;
            $locationOfWork->save();
        }

        return redirect()->route('operation.create', [
            'estimate' => $estimate,
            'location_of_work' => $locationOfWork]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationOfWork $locationOfWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estimate $estimate, LocationOfWork $location_of_work)
    {
        return view('location_of_work.edit', ['estimate' => $estimate,'location_of_work' => $location_of_work]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationOfWorkRequest $request, Estimate $estimate, LocationOfWork $location_of_work)
    {
        foreach($request->descriptions as $d){
            if(filled($d)){
                $description = New DescriptionLocation();
                $description->location_of_work_id = $location_of_work->id;
                $description->content = $d;
                $description->save();
            }
        }

        $message = 'Travaux dans "' . ucfirst(strtolower($location_of_work->room->name)) .'" ajouté au devis de ' . ucfirst(strtolower($estimate->customer->firstname)) .' '. strtoupper($estimate->customer->lastname) . '. Cliquez en haut à droite si vous avez terminé, sinon choisissez une nouvelle pièce pour poursuivre le devis.';

        $request->session()->flash('success', $message);

        return redirect()->route('location_of_work.create', ['estimate' => $estimate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationOfWork $locationOfWork)
    {
        //
    }
}
