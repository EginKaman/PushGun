<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __invoke(PasswordUpdate $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors('error', __('You have entered wrong password'));
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('account.index');
    }
}
