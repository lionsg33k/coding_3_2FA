<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorAuthMailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TwoFactorAuthController extends Controller
{
    //

    public function index()
    {
        return view("auth.2fa");
    }



    public function store()
    {



        $user = User::where("id", auth()->user()->id)->first();

        if ($user && $user->tfa_enable) {
            //*  ila  kan  2fa  khdama  kaymchi itfiha
            $user->tfa_enable = false;
        } else {
            //*  ila  kan  2fa  makhdamach  kaymchi ikhademha
            $user->tfa_enable = true;
            $code = random_int(1000, 9999);
            $user->tfa_code =  $code;
            Mail::to($user->email)->send(new TwoFactorAuthMailer($code));
        }


        $user->save();

        return back();
    }


    public function validateCode(Request $request)
    {


        request()->validate([
            "code" => "required|integer|min:1000"
        ]);


        $user = User::where("id", auth()->user()->id)->first();

        if ($user->tfa_code == $request->code) {
            $user->allow_pass = true;
            $user->save();
            return redirect()->route("dashboard");
        }

        return back();
    }
}
