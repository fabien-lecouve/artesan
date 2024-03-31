<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profiles\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request): View
    {
        $profile = $request->user();

        return view('profile.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        $profile = $request->user();

        return view('profile.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $profile = $request->user();

        $profile->lastname = $request->lastname;
        $profile->firstname = $request->firstname;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        if ($request->filled('complementary_address')) {
            $profile->complementary_address = $request->complementary_address;
        }
        $profile->postal_code = $request->postal_code;
        $profile->city = $request->city;

        $profile->company = $request->company;
        $profile->rm_number = $request->rm_number;

        $profile->insurance_name = $request->insurance_name;
        $profile->insurance_address = $request->insurance_address;

        if ($request->filled('password')) {
            $profile->password = Hash::make($request->input('password'));
        }

        if ($request->file('artisan_logo_path')) {
            $imagePath = $request->file('artisan_logo_path')->storeAs(
                'images', 
                Auth::id() . '.artisan_logo' . $request->file('artisan_logo_path')->getClientOriginalExtension(),
                'public');

            $profile->artisan_logo_path = $imagePath;
        }
        if ($request->file('qualifelec_logo_path')) {
            $imagePath = $request->file('qualifelec_logo_path')->storeAs(
                'images', 
                Auth::id() . '.qualifelec_logo' . $request->file('qualifelec_logo_path')->getClientOriginalExtension(),
                'public');

            $profile->qualifelec_logo_path = $imagePath;
        }

        $profile->save();

        $request->session()->flash('success', 'Votre profil a bien été modifié');

        return redirect()->route('profile.show');
    }
}
