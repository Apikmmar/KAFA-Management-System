<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    //
    public function profile() {
        $user = Auth::user();

        return view('ManageAccount.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id) {
        $user = User::findOrFail($id);
    
        $validatedData = $request->validated();
    
        if ($request->hasFile('user_verification')) {
            if ($user->user_verification && Storage::disk('public')->exists($user->user_verification)) {
                Storage::disk('public')->delete($user->user_verification);
            }

            $file = $request->file('user_verification');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('Parent Verification', $fileName, 'public');
            $user->user_verification = $path;
        }

        // not working
        if ($request->filled('new_password')) {
            $user->password = Hash::make($validatedData['new_password']);
        }
    
        $user->update([
            'user_ic' => $validatedData['user_ic'],
            'user_name' => $validatedData['user_name'],
            'user_gender' => $validatedData['user_gender'],
            'user_contact' => $validatedData['user_contact'],
            'email' => $validatedData['email'],
        ]);
    
        return redirect()->route('profile')->with('message', 'Successfully Update Profile');
    }

    public function registerteacher() {

        return view('ManageAccount.registerteacher');
    }

    public function createteacher() {

        return redirect()->route('registerteacher')->with('message', 'Successfully Update Profile');
    }
}