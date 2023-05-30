<?php

namespace App\Http\Controllers;

use App\Models\kas;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $page = request(['pagination'][0]) ?? 10;
        $hari = request(['hari'][0]) ?? date('d');
        $bulan = request(['bulan'][0]) ?? date('m');
        $tahun = request(['tahun'][0]) ?? date('Y');
        $kind = request(['kind'][0]) ?? '';
        $metode = request(['metode'][0]) ?? '';


        if ($bulan == 0) {
            $tahun = $tahun - 1;
            $bulan = 12;
        }
        if ($bulan == 13) {
            $tahun = $tahun + 1;
            $bulan = 1;
        }
        if ($hari != 'All') {
            $laporan = Transaksi::orderBy('created_at', 'asc')->filter(request(['search', 'kind', 'metode']))->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->whereDay('created_at', $hari)->paginate($page);
        } else {
            $laporan = Transaksi::orderBy('created_at', 'asc')->filter(request(['search', 'kind', 'metode']))->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->paginate($page);
        }

        return view('Laporan.Index', [
            'transaksi' => $laporan,
            'search' => request()->search,
            'page' => $page,
            'panel' => ['laporan', 'laporan'],
            'bulan' => $bulan,
            'tahun' => $tahun,
            'hari' => $hari,
            'kind' => $kind,
            'metode' => $metode,
            'kas' => kas::all()
        ]);
    }
}
