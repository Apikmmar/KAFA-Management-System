<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTeacherRequest;
use App\Http\Requests\RegisterChildRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Student;
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

        return view('ManageAccount.KAFA-Admin.registerteacher');
    }

    public function createteacher(AddTeacherRequest $request) {

        $data = $request->validated();

        $user = User::create([
            'role_id' => 4,
            'user_name' => $data['user_name'],
            'user_ic' => $data['user_ic'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_gender' => $data['user_gender'],
            'user_contact' => $data['user_contact'],
            'user_verification' => isset($path) ? $path : 'path',
        ]);

        
        if (request()->hasFile('user_verification')) {
            $file = request()->file('user_verification');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('Parent Verification', $fileName, 'public');
            $user->user_verification = $path;
            $user->save();
        }
        
        return redirect()->route('registerteacher')->with('message', 'Successfully Create Teacher Account');
    }

    public function registerchild() {

        return view('ManageAccount.Parent.registerchild');
    }

    public function createchild(RegisterChildRequest $request) {
        $parent = Auth::user();

        $data = $request->validated();

        $child = Student::create([
            'student_ic' => $data['child_ic'],
            'parent_id' => $parent->id,
            'student_name' => $data['child_name'],
            'student_age' => (int) $data['child_age'],
            'student_gender' => $data['child_gender'],
            'student_verification' => isset($path) ? $path : 'path',
        ]);

        if (request()->hasFile('child_verification')) {
            $file = request()->file('child_verification');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('Student Verification', $fileName, 'public');
            $child->student_verification = $path;
            $child->save();
        }

        return redirect()->route('registerchild')->with('message', 'Successfully Register Child');
    }
}