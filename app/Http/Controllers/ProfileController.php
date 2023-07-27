<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

   
public function update(ProfileUpdateRequest $request)
{
    $user = auth()->user();

    // Update name and email
    $user->name = $request->name;
    $user->email = $request->email;

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Save the changes to the database
    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profile updated.');
}
}
