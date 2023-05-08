<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Hamcrest\Core\HasToString;
use App\Models\InvoiceCreartor;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class BendaharaController extends Controller
{
    public function tagihanManeger()
    {
        $page = request(['pagination'][0]) ?? 10;
        $invoice = [];
        foreach (InvoiceCreartor::filter(request(['search']))->paginate($page) as $item) {

            $kepada = json_decode($item->kepada);
            // dd($kepada);
            if ($kepada->kind == "umum") {
                $kelamin = "";
                if ($kepada->value->kelamin == 0) {
                    $kelamin = '';
                }
                if ($kepada->value->kelamin == 1) {
                    $kelamin = 'Kang';
                }
                if ($kepada->value->kelamin == 2) {
                    $kelamin = 'Mbak';
                }
                $kepada->value->kelas == 0 ? $kelas = 'Semua Kelas' :
                    $kelas = Kelas::where('id', $kepada->value->kelas)->get()[0]->name;
                $kepada = $kelamin . " " . $kelas;
                $item['kepada'] = $kepada;
                $invoice[] = $item;
            } else {

                $kepada = User::where('nis', $kepada->value->nis)->get()[0]->name;
                $item['kepada'] = $kepada;
                $invoice[] = $item;
            }
        }


        return view('Bendahara.TagihanManager', [
            'page' => $page,
            'search' => request(['search'][0]),
            'page1' => InvoiceCreartor::filter(request(['search']))->paginate($page),
            'invoice' => $invoice,
            'panel' => ['bendahara', 'invoice.menejer'],

        ]);
    }

    public function add()
    {
        return view('Bendahara.AddTagihan', [
            'panel' => ['bendahara', 'invoice.menejer'],

        ]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'keterangan' => 'required|max:10000',
            'jumlah' => 'required|integer',
            'period' => 'required',

        ]);
        if ($request->kind == "umum") {

            $data['kepada'] = json_encode(['kind' => 'umum', 'value' => ['kelamin' => $request->kelamin, 'kelas' => $request->kelas_id]]);
        }
        if ($request->kind == "spesifik") {
            $request->validate([
                'kepada' => 'required|exists:users,nis'
            ]);
            $data['kepada'] = json_encode(['kind' => 'spesifik', 'value' => ['nis' => $request->kepada]]);
        }

        InvoiceCreartor::create($data);
        return redirect(route('bendahara.tagihan.menejer'));
    }

    public function edit($id)
    {

        $data = InvoiceCreartor::where('id', $id)->get()[0];

        $kind = json_decode($data->kepada)->kind;
        $data['kepada'] = json_decode($data->kepada)->value;
        return view('Bendahara.EditTagihan', [
            'panel' => ['bendahara', 'invoice.menejer'],
            'kind' => $kind,
            'data' => $data

        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'keterangan' => 'required|max:10000',
            'jumlah' => 'required|integer',
            'period' => 'required',

        ]);
        if ($request->kind == "umum") {

            $data['kepada'] = json_encode(['kind' => 'umum', 'value' => ['kelamin' => $request->kelamin, 'kelas' => $request->kelas_id]]);
        }
        if ($request->kind == "spesifik") {
            $request->validate([
                'kepada' => 'required|exists:users,nis'
            ]);
            $data['kepada'] = json_encode(['kind' => 'spesifik', 'value' => ['nis' => $request->kepada]]);
        }

        InvoiceCreartor::where('id', $id)->update($data);
        return redirect(route('bendahara.tagihan.menejer'));
    }
    public function delete($id)
    {
        InvoiceCreartor::destroy($id);
        return redirect(route('bendahara.tagihan.menejer'));
    }


    public function tagihan()
    {

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

        return view('Bendahara.Tagihan', [
            'invoice' => Invoice::where('user_id', Auth::user()->id)->where('status', 'belum lunas')->get(),
            'panel' => ['bendahara', 'invoice'],
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }
    public function report()
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

        return view('perpustakaan.laporanPeminjaman', [
            'imnoice' => Invoice::latest()->filter(request(['search']))->whereMonth('created_at', $bulan)->whereYear('tanggal_pinjam', $tahun)->paginate($page),
            'page' => $page,
            'search' => request(['search'][0]),
            'panel' => ['perpus', 'laporan'],
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }
}
