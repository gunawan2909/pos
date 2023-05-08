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


        return view('Registrasi.Registrasi', [
            'panel' => 'santri',

        ]);
    }
    public function registrasi()
    {
        $token = mt_rand(1000000, 9999999);
        $data = request()->validate([
            'nik' => 'required',
            'email' => 'required|unique:users|email',
            'name' => 'required',
            'no_hp' => 'required',
            'password' => 'required|min:8|confirmed',


        ]);
        $data['token_no_hp'] = $token;
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        Auth::attempt((request()->only('email', 'password')));
        $this->sendotp(Auth::user()->id);
        event(new Registered(Auth::user()));
        return redirect(route('otp', ['nik' => Auth::user()->nik]));
    }

    public function sendotp($id)
    {
        $user = User::where('id', $id)->get();
        $user = $user[0];
        $massage = 'Ini *kode OTP* Anda *' . $user->token_no_hp . '* untuk tindakan keamanan tambahan. Mohon tidak menyebarkannya dan hanya untuk tujuan verifikasi identitas. Masukkan kode ini pada layar verifikasi untuk melanjutkan ke tahap selanjutnya. Terima kasih atas perhatian Anda.';
        Http::post('https://ppnh.co.id:2053/send-message', ['number' => $user->no_hp, 'message' => $massage]);
    }

    public function sendotpback($nik)
    {
        return view('Registrasi.SendbackotpWhatsAppConfirmed', [
            'user' => User::where('nik', $nik)->get()[0]
        ]);
    }
    public function sendotpbackupdate($nik)
    {

        $user = User::where('nik', $nik)->get()[0];

        if ($user->no_hp == request()->no_hp) {
            $this->sendotp($user->id);
            return redirect(route('otp', ['nik' => $nik]));
        } else {
            User::where('nik', $nik)->update(['no_hp' => request()->no_hp]);
            $this->sendotp($user->id);
            return redirect(route('otp', ['nik' => $nik]));
        }
    }

    public function otp($nik)
    {
        $user = User::where('nik', $nik)->get()[0];
        return view('Registrasi.WhatsAppConfirmed', [
            'user' => $user
        ]);
    }
    public function storeotp($nik)
    {
        request()->validate([
            'otp' => ['required', Rule::in(User::where('nik', $nik)->get()[0]->token_no_hp)]
        ]);
        User::where('nik', $nik)->update(['token_no_hp' => 'validated']);
        return redirect('/');
    }
}
