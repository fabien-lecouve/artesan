<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\Materials\StoreMaterialRequest;
use App\Http\Requests\Materials\UpdateMaterialRequest;
use App\Models\Category;
use App\Models\Price;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('material.index', [
                                        'materials' => Material::where('user_id', Auth::id())->get(),
                                        'categories' => Category::where('user_id', Auth::id())->orderBy('name')->get()
                                    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material.create', ['categories' => Category::orderBy('name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        try {
            DB::beginTransaction();

            $material = new Material();

            $material->name = $request->name;
            $material->category_id = $request->category_id;
            $material->user_id = Auth::id();
            $material->description = $request->description;

            $material->start_of_description_for_several = $request->filled('start_of_description_for_several') ? $request->start_of_description_for_several : null;
            $material->end_of_description_for_several = $request->filled('end_of_description_for_several') ? $request->end_of_description_for_several : null;

            $material->save();

            $newPrice = new Price();
            $newPrice->material_id = $material->id;
            $newPrice->mode_of_work_id = 1;
            $newPrice->unit_price = $request->new_unit_price;
            $newPrice->workforce_price = $request->new_workforce_price;
            $newPrice->save();

            $renovationPrice = new Price();
            $renovationPrice->material_id = $material->id;
            $renovationPrice->mode_of_work_id = 2;
            $renovationPrice->unit_price = $request->renovation_unit_price;
            $renovationPrice->workforce_price = $request->renovation_workforce_price;
            $renovationPrice->save();

            DB::commit();

            $request->session()->flash('success', 'La fourniture '.$material->name.' a bien été créée');

            return redirect()->route('material.index');

        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('failed', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material): View
    {
        return view('material.show', ['material' => $material]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material): View
    {
        return view('material.edit', [
            'material' => $material,
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $material->name = $request->name;
            $material->category_id = $request->category_id;
            $material->description = $request->description;

            $material->start_of_description_for_several = $request->filled('start_of_description_for_several') ? $request->start_of_description_for_several : null;
            $material->end_of_description_for_several = $request->filled('end_of_description_for_several') ? $request->end_of_description_for_several : null;

            $material->save();

            foreach($material->prices as $price){
                if($price->mode_of_work_id === 1){
                    $price->unit_price = $request->new_unit_price;
                    $price->workforce_price = $request->new_workforce_price;
                    $price->save();
                } else {
                    $price->unit_price = $request->renovation_unit_price;
                    $price->workforce_price = $request->renovation_workforce_price;
                    $price->save();
                }
            }

            DB::commit();

            $request->session()->flash('success', 'La fourniture '.$material->name.' a bien été modifiée');

            return redirect()->route('material.index');

        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('failed', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material): RedirectResponse
    {
        try {
            DB::beginTransaction();

            foreach($material->prices as $price){
                $price->delete();
            }

            $material->delete();

            DB::commit();

            return back()->with('success', 'Fourniture '.$material->name.' effacée avec succès');

        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('failed', $th->getMessage());
        }
    }
}
