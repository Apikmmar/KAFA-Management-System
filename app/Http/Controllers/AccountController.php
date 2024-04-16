<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function profile() {
        $user = Auth::user();

        return view('ManageAccount.profile', compact('user'));
    }
}
