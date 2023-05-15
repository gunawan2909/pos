<?php

namespace App\Http\Controllers;

use App\Models\kas;
use App\Models\Transaksi;
use App\Models\Persediaan;
use App\Models\RiwayatPersediaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PersediaanController extends Controller
{
    public function index()
    {

        return view('Persediaan.Persediaan', [
            'persediaan' => Persediaan::latest()->orderBy('name', 'ASC')->get(),
            'panel' => ['persediaan', 'index'],

            'search' => request(['search'][0]),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'satuan' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'satuan' =>  $request->satuan,
            'jumlah' => 0,
        ];


        Persediaan::create($data);
        return redirect(route('persediaan'))->with('status', 'Persediaan Berhasil ditambahkan');
    }

    public function edit($id)
    {

        return view('Persediaan.Persediaan', [
            'panel' => ['persediaan', 'index'],
            'id' => $id,

            'search' => request(['search'][0]),
            'persediaan' => Persediaan::latest()->orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'satuan' => 'required',
        ]);

        Persediaan::where('id', $id)->update($data);
        return redirect(route('persediaan'))->with('status', 'Persediaan berhasil diubah');
    }

    public function delete($id)
    {
        $persediaan = Persediaan::where('id', $id)->get()[0];
        if ($persediaan->list->count() < 1) {

            Persediaan::where('id', $id)->delete();
            return redirect(route('persediaan'))->with('status', 'Persediaan berhasil dihapus');
        }
        return redirect(route('persediaan'))->with('status', 'Persediaan tidak dapat dihapus terhubung dengan menu');
    }

    public function restock($id)
    {
        return view('Persediaan.PersediaanRestok', [
            'persediaan' => Persediaan::where('id', $id)->get()[0],
            'panel' => ['persediaan', 'index'],

        ]);
    }
    public function restockStore(Request $request, $id)
    {
        $data = $request->validate([
            'jumlah' => 'required|integer',
            'nominal' => 'required|integer',
            'kuitansi' => 'required|image|max:3000',
        ]);
        $jumlah = Persediaan::where('id', $id)->get()[0]['jumlah'] + $request->jumlah;
        Persediaan::where('id', $id)->update(['jumlah' => $jumlah]);
        $kas = kas::where('name', 'tunai')->get()[0]->nominal - $request->nominal;
        kas::where('name', 'tunai')->update(['nominal' => $kas]);
        $keterangan = "Pembelaian " . Persediaan::where('id', $id)->get()[0]['name'];
        $kind = "500";
        $kuitansi = $request->file('kuitansi') ? $request->file('kuitansi')->store('transasi') : '';
        $transaksi = Transaksi::create([
            'keterangan' => $keterangan,
            'kind' => $kind,
            'nominal' => $request->nominal,
            'status' => "Sukses",
            'metode' => "Tunai",
        ]);
        $data['kuitansi'] = $kuitansi;
        $data['transaksi_id'] = $transaksi->id;
        $data['persediaan_id'] = $id;
        $data['nominal'] = $request->nominal;

        RiwayatPersediaan::create($data);
        return redirect(route('persediaan'))->with('status', 'Persediaan berhasil direstock');
    }

    public function riwayat()
    {
        $page = request()->pagination ?? 10;
        return view('Persediaan.Riwayat', [
            'riwayat' => RiwayatPersediaan::latest()->paginate($page),
            'panel' => ['persediaan', 'riwayat'],
            'page' => $page,
            'search' => request()->search

        ]);
    }

    public function riwayatEdit($id)
    {

        return view('Persediaan.PersediaanRestokEdit', [
            'riwayat' => RiwayatPersediaan::where('id', $id)->get()[0],
            'panel' => ['persediaan', 'riwayat'],


        ]);
    }

    public function riwayatUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'jumlah' => 'required|integer',
            'nominal' => 'required|integer',
            'kuitansi' => 'image|max:3000',
        ]);
        $riwayat = RiwayatPersediaan::where('id', $id)->get()[0];
        $jumlah =  $riwayat->persediaan->jumlah - $riwayat->jumlah + $request->jumlah;
        Persediaan::where('id',  $riwayat->persediaan->id)->update(['jumlah' => $jumlah]);
        $kas = kas::where('name', 'tunai')->get()[0]->nominal  + $riwayat->nominal - $request->nominal;

        kas::where('name', 'tunai')->update(['nominal' => $kas]);
        $kuitansi = $riwayat->kuitansi;
        if ($request->file('kuitansi')) {
            $kuitansi =  $request->file('kuitansi')->store('transasi');
            Storage::delete($riwayat->kuitansi);
        }
        Transaksi::where('id', $id)->update([
            'nominal' => $request->nominal,

        ]);
        $data['kuitansi'] = $kuitansi;
        $riwayat->update($data);
        return redirect(route('persediaan.riwayat'))->with('status', 'Data berhasil diubah');
    }
    public function riwayatDelete($id)
    {
        $riwayat = RiwayatPersediaan::where('id', $id)->get()[0];
        $nominal = kas::where('name', 'tunai')->get()[0]->nominal + $riwayat->nominal;
        kas::where('name', 'tunai')->update(['nominal' => $nominal]);
        $jumlah = Persediaan::where('id', $riwayat->persediaan->id)->get()[0]->jumlah - $riwayat->jumlah;
        Persediaan::where('id', $riwayat->persediaan->id)->update(['jumlah' => $jumlah]);
        RiwayatPersediaan::destroy($id);
        return redirect()->back()->with('status', 'Data berhasil dihapus');
    }
}
