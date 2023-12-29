<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\Rooms\StoreRoomRequest;
use App\Http\Requests\Rooms\UpdateRoomRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('room.index', ['rooms' => Room::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request): RedirectResponse
    {
        Room::create($request->all());

        $request->session()->flash('success', 'La pièce ' . ucfirst(strtolower($request->name)) .' a bien été créé');

        return redirect()->route('room.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room): View
    {
        return view('room.edit', ['room' => $room]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room): RedirectResponse
    {
        $room->fill($request->all());
        $room->save();

        $request->session()->flash('success', 'La pièce ' . ucfirst(strtolower($room->name)) .' a bien été modifié');

        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
