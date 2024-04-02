<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login( ){
        return view('auth.login');
    }

    public function handleLogin(AuthRequest $request)
    {
        // dd($request->only(['email','password']));  ====== cela pour tester dans la page kay3tiw dik la page lifiha ga3 les infos

        $credentials = $request->only(['email','password']);

        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }else{
            return redirect()-> back()->with('ereur_message','parametre de connexion non valide');
        }
    }
}
