<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSantriController extends Controller
{
    public function datadaftarulang()
    {
        $page = request(['pagination'][0]) ?? 10;
        return view('DataSantri.DatasantriDaful', [
            'panel' => ['datasantri', 'data daftar ulang'],
            'page' => $page,
            'search' => request(['search'][0]),
            'user' => User::where('status', 'belum lunas pembayaran ')->orwhere('status', 'belum daftar ulang')->filter(request(['search']))->orderBy('nis', 'ASC')->paginate($page),


        ]);
    }

    public function editDataDaful($nik)
    {
        return view('DataSantri.EditDaful', [
            'user' => User::where('nik', $nik)->get(),
            'panel' => ['datasantri', 'data daftar ulang'],
        ]);
    }
    public function deleteDataDaful($nik)
    {
        User::where('nik', $nik)->delete();
        // User::destroy());
        return redirect(route('datadaftarulang'));
    }

    public function UpdateDataDaful($nik)
    {
        request()->validate([
            'nis' => 'required|unique:users',
            'kelas_id' => 'required',
            'konfirmasi' => 'required'
        ]);

        $data = [
            'nis' => request()->nis,
            'kelas_id' => request()->kelas_id,
            'status' => "belum daftar ulang",
        ];
        User::where('nik', $nik)->update($data);
        return redirect(route('daftarulang'));
    }

    public function daftarulang()
    {
        return view('DataSantri.DaftarUlang', [
            'panel' => ['datasantri', 'daftar ulang'],
        ]);
    }
    public function formdaftarulang()
    {
        $wilayah = new Wilayah();
        return view('DataSantri.FormDaftarUlang', [
            'panel' => ['datasantri', 'daftar ulang'],
            'provinsi' => $wilayah->data('provinsi')
        ]);
    }

    public function updateformdaftarulang()
    {
        request()->validate([
            'alamat1' => 'required',
            'alamat2' => 'required',
            'acc' => 'required',
        ]);
        $data = request()->validate([
            'kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'ayah' => 'required',
            'ibu' => 'required',
            'no_wali' => 'required',
            'universitas' => 'required',
            'prodi' => 'required',
            'jenjang' => 'required',
            'tahun_masuk' => 'required',
        ]);
        $data['alamat'] = request()->alamat1 . "&" . request()->alamat2;
        $data['status'] = "aktif";
        User::where('id', Auth::user()->id)->update($data);
        return redirect(route('daftarulang'));
    }

    public function datasantri()
    {
        $page = request(['pagination'][0]) ?? 10;
        return view('DataSantri.Datasantri', [
            'page' => $page,
            'search' => request(['search'][0]),
            'user' => User::where('status', 'aktif')->filter(request(['search']))->orderBy('nis', 'ASC')->paginate($page),
            'panel' => ['datasantri', 'data santri'],
        ]);
    }
}
