<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\CodeAbsen;
use App\Models\RiwayatAbsen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function riwayat()
    {
        $page = request(['pagination'][0]) ?? 10;
        $bulan = request(['bulan'][0]) ?? date('m');
        $tahun = request(['tahun'][0]) ?? date('Y');

        if ($bulan == 0) {
            $tahun = $tahun - 1;
            $bulan = 12;
        }
        if ($bulan == 13) {
            $tahun = $tahun + 1;
            $bulan = 1;
        }
        return view('Jadwal.Riwayat', [
            'absen' => RiwayatAbsen::latest()->filter(request(['search']))->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->paginate($page),
            'search' => request()->search,
            'page' => $page,
            'panel' => ['jadwal', 'riwayat'],
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }
    public function rolle()
    {
        return view('Jadwal.Rolle', [
            'panel' => ['jadwal', 'role'],
            'jadwal' => Jadwal::all()

        ]);
    }
    public function absen()
    {
        return view('Jadwal.Absen', [
            'panel' => ['jadwal', 'absen'],

        ]);
    }
    public function generate()
    {
        return view('Jadwal.Generate', [
            'panel' => ['jadwal', 'generate'],
            'code' => CodeAbsen::first()->get()[0]

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        if (CodeAbsen::first()->get()[0] == $request->code) {
            RiwayatAbsen::create(['user_id' => Auth::user()->id, 'status' => 'Hadir']);
            
            return redirect(route('absen.riwayat'));
        }

        return back()->withErrors('code', 'Code Absen yang anda masuakn salah');
    }
}
