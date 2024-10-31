<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordMailer;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->role);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role.*' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $password = Str::random(10);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'role' => $request->role,
            'password' => Hash::make($password),
        ]);

        event(new Registered($user));


        //* to assign  one role  =>  use   the role name

        // $user->assignRole($request->role);

        //* to assign multiple roles =>  use the role ID

        $user->roles()->attach($request->role);

        //* to check user role 

        // if ($user->hasRole("admin")) {
        //     dd("hello admin");
        // }

        Mail::to($user->email)->send(new PasswordMailer($password));

        // Auth::login($user);

        if ($user->hasRole("seller")) {
            dd("jh");
        }

        return redirect(route('dashboard', absolute: false));
    }
}
