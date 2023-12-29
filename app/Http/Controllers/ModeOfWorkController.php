<?php

namespace App\Http\Controllers;

use App\Models\ModeOfWork;
use App\Http\Requests\ModeOfWorks\StoreModeOfWorkRequest;
use App\Http\Requests\ModeOfWorks\UpdateModeOfWorkRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ModeOfWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mode_of_work.index', ['mode_of_works' => ModeOfWork::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('mode_of_work.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModeOfWorkRequest $request): RedirectResponse
    {
        ModeOfWork::create($request->all());

        $request->session()->flash('success', 'Le mode de travaux "' . ucfirst(strtolower($request->name)) .'" a bien été créé');

        return redirect()->route('mode_of_work.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModeOfWork $modeOfWork): View
    {
        return view('mode_of_work.edit', ['mode_of_work' => $modeOfWork]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModeOfWorkRequest $request, ModeOfWork $modeOfWork): RedirectResponse
    {
        $modeOfWork->fill($request->all());
        $modeOfWork->save();

        $request->session()->flash('success', 'Le mode de travaux "' . ucfirst(strtolower($modeOfWork->name)) .'" a bien été modifié');

        return redirect()->route('mode_of_work.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModeOfWork $modeOfWork)
    {
        //
    }
}
