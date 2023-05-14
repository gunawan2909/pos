<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function index()
    {;


        return view('Registrasi.Registrasi', []);
    }
    public function registrasi()
    {

        $data = request()->validate([
            'email' => 'required|unique:users|email',
            'name' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        Auth::attempt((request()->only('email', 'password')));
        // event(new Registered(Auth::user()));
        return redirect(route('dashboard'));
    }
}
