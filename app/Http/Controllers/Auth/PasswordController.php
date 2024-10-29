<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */

    public function index()
    {
        return view("auth.change_password");
    }


    public function update(Request $request): RedirectResponse
    {


        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $user = User::where("id", auth()->user()->id)->first();
        if ($user && !$user->password_changed) {
            $user->password_changed = true;
            $user->save();
        }


        return redirect(route("dashboard"))->with('status', 'password-updated');
    }
}
