<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\Statuses\StoreStatusRequest;
use App\Http\Requests\Statuses\UpdateStatusRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('status.index', ['statuses' => Status::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request): RedirectResponse
    {
        Status::create($request->all());

        $request->session()->flash('success', 'Le statut ' . ucfirst(strtolower($request->name)) .' a bien été créé');

        return redirect()->route('status.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status): View
    {
        return view('status.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status): RedirectResponse
    {
        $status->fill($request->all());
        $status->save();

        $request->session()->flash('success', 'Le statut ' . ucfirst(strtolower($status->name)) .' a bien été modifié');

        return redirect()->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        //
    }
}
