<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use function Ramsey\Uuid\v1;

class UserController extends Controller
{
    public function index()
    {
        return view('User.Profile', [
            'panel' => ['user', 'profile'],
            'user' => Auth::user(),

        ]);
    }
    public function edit($nis)
    {
        return view('User.Edit', [
            'panel' => ['user', 'profile'],
            'user' => User::where('nis', $nis)->get()[0],

        ]);
    }

    public function update()
    {
        $data = request()->validate([
            'nik'
        ]);
    }

    public function wifi()
    {
        $wifi = [];
        $data = Http::withBasicAuth('Gun', '@Ind170845')->get('https://mikrotik.ppnh.co.id/rest/ip/hotspot/user')->getBody();
        $data = json_decode($data, true);

        foreach ($data as $item) {
            if ($item['name'] == Auth::user()->nis) {
                $wifi = $item;
            }
        }
        $aktif = [];
        $aktifs = [];
        $data = Http::withBasicAuth('ssa', 'IT@nh2021')->get('https://mikrotik.ppnh.co.id/rest/ip/hotspot/active')->getBody();
        $data = json_decode($data, true);
        $dhcp = Http::withBasicAuth('ssa', 'IT@nh2021')->get('https://mikrotik.ppnh.co.id/rest/ip/dhcp-server/lease')->getBody();
        $dhcp = json_decode($dhcp, true);

        foreach ($data as $item) {
            foreach ($dhcp as $dh) {
                if ($dh['address'] == $item['address']) {
                    $item['dhcp'] = $dh;
                }
            }
            $aktifs[] = $item;
        }



        foreach ($aktifs as $item) {
            if ($item['user'] == Auth::user()->nis) {
                $aktif[] = $item;
            }
        }


        return view('User.Wifi', [
            'panel' => ['wifi', 'wifi'],
            'wifi' => $wifi,
            'aktif' => $aktif
        ]);
    }

    public function deleteAktifWiFi(Request $request)
    {
        $url = 'https://mikrotik.ppnh.co.id/rest/ip/hotspot/active/' . request()->id;

        Http::withBasicAuth('ssa', 'IT@nh2021')->delete($url);
        return redirect()->back()->with('sukses_perangkat', 'Perangkat berhasil dihapus');
    }

    public function addWiFi()
    {

        request()->validate(['password' => 'required']);
        $url = 'https://mikrotik.ppnh.co.id/rest/ip/hotspot/user/add';
        $body = ([
            'name' => request()->name,
            'password' => request()->password,
            'profile' => 'santri',
            'comment' => Auth::user()->name
        ]);

        (Http::withBasicAuth('ssa', 'IT@nh2021')->post($url, $body));
        return back()->with('status', 'Akun berhasil dibuat');
    }

    public function updateWiFi()
    {
        request()->validate([

            'password' => 'required'
        ]);

        $url = 'https://mikrotik.ppnh.co.id/rest/ip/hotspot/user/' . request()->id;
        $body = ([
            'password' => request()->password,
        ]);

        Http::withBasicAuth('ssa', 'IT@nh2021')->patch($url, $body);
        return back()->with('status', 'Akun berhasil diubah');
    }
}
