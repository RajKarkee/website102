<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Userpic;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());


        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'image' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('profile_pics', 'public');

            if (Auth::user()->userpic) {
                $userpic = Auth::user()->userpic;
                Storage::disk('public')->delete($userpic->image);
                $userpic->image = $imagePath;
                $userpic->save();
            } else {
                $userpic = new Userpic();
                $userpic->user_id = $user->id;
                $userpic->image = $imagePath;
                $userpic->save();
            }
        }

        $user->save();


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


}
