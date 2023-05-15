<?php

namespace App\Http\Controllers;

use App\Models\kas;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\PesananList;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function add()
    {
        return view('Reservasi.Registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([]);
        $data = $request->validate([
            'name' => 'required',
            'no_wa' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $data['status'] = 'Unpaid';
        $data['jumlah'] = 0;
        $data['kind'] = "reservasi";


        $pesanan = Pesanan::create($data);
        return redirect(route('pesanan.reservasi.kuota', ['id' => $pesanan->id]));
    }


    public function kuota($id)
    {
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $kuota = 40;
        foreach (Pesanan::where('date', $pesanan->date)->get() as $item) {
            if (abs(strtotime($item->time) - strtotime($pesanan->time)) < 72000) {
                $kuota -= $item->jumlah;
            }
        }


        return view('Reservasi.Kuota', [
            'pesanan' => $pesanan,
            'kuota' => $kuota,
            'menu' => Menu::where('status', true)->get()

        ]);
    }

    public function kuotaStore($id, Request $request)
    {
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $kuota = 40;
        foreach (Pesanan::where('date', $pesanan->date)->get() as $item) {
            if (abs(strtotime($item->time) - strtotime($pesanan->time)) < 72000) {
                $kuota -= $item->jumlah;
            }
        }
        $role = 'required|numeric|max:' . $kuota;

        $data = $request->validate([
            'jumlah' => $role,

        ]);
        $pesanan->update($data);
        return redirect(route('pesanan.reservasi.list', ['id' => $pesanan->id]));
    }

    public function create($id)
    {
        $pesanan = Pesanan::where('id', $id)->get()[0];


        return view('Reservasi.List', [
            'pesanan' => $pesanan,
            'menu' => Menu::where('status', true)->get()

        ]);
    }

    public function listStore(Request $request)
    {
        $data = $request->validate([
            'menu_id' => 'required',
            'pesanan_id' => 'required',
            'jumlah' => 'required',
        ]);
        $data['keterangan'] = $request->keterangan ?? 'Tidak ada';
        PesananList::create($data);
        return back();
    }
    public function listDelete($id)
    {
        PesananList::destroy($id);
        return back();
    }

    public function dp($id)
    {
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $total = 0;

        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $total = $total / 2;
        $params = array(
            'transaction_details' => array(
                'order_id' => "dp-" . $pesanan->id . "-" . rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $pesanan->name,
                'last_name' => '',

                'phone' => $pesanan->no_wa,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('Reservasi.Invoice', [
            'pesanan' => Pesanan::where('id', $id)->get()[0],
            'total' => $total,
            'snapToken' => $snapToken
        ]);
    }
    public function reservasi($id)
    {
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $total = 0;

        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        $total = $total / 2;
        $snapToken = '';
        if ($pesanan->status == 'Down Payment Paid') {

            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
            $params = array(
                'transaction_details' => array(
                    'order_id' => "po-" . $pesanan->id . "-" . rand(),
                    'gross_amount' => $total,
                ),
                'customer_details' => array(
                    'first_name' => $pesanan->name,
                    'last_name' => '',

                    'phone' => $pesanan->no_wa,
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        }
        return view('Reservasi.Reservasi', [
            'pesanan' => Pesanan::where('id', $id)->get()[0],
            'total' => $total,
            'snapToken' => $snapToken
        ]);
    }

    public function callbackpayout(Request $request)
    {
        $serverKey = config('midtrans.serverKey');


        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $data = explode($request->order_id, '-');
                if ($data[0] == 'dp') {
                    Pesanan::where('id', $data[1])->update(['status' => 'Down Payment Paid']);
                }
                if ($data[0] == 'po') {
                    Pesanan::where('id', $data[1])->update(['status' => 'Paid']);
                }
            }
        }
    }
    public function listAdd(Request $request, $id)
    {
        $jumlah = $request->jumlah + 1;
        PesananList::where('id', $id)->update(['jumlah' => $jumlah]);
        return back();
    }
    public function listMinus(Request $request, $id)
    {
        $jumlah = $request->jumlah - 1;
        PesananList::where('id', $id)->update(['jumlah' => $jumlah]);
        return back();
    }


    public function status($id)
    {
        return view('Reservasi.Status', [
            'pesanan' => Pesanan::where('id', $id)->get()[0]
        ]);
    }
    public function pay($id)
    {
        $total = 0;
        $pesanan = Pesanan::where('id', $id)->get()[0];
        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        $total = $total / 2;
        Pesanan::where('id', $id)->update(['status' => 'Paid']);
        $kas = kas::where('name', 'tunai')->get()[0]->nominal  +  $total;
        kas::where('name', 'tunai')->update(['nominal' => $kas]);
        $keterangan = "Pendapatan Penjualan / Pelunasan Dp  " . $pesanan->name;
        $kind = "600";
        $transaksi = Transaksi::create([
            'keterangan' => $keterangan,
            'kind' => $kind,
            'nominal' => $total,
            'status' => "Sukses",
            'metode' => "Tunai",
        ]);
        return redirect(route('pesanan.reservasi.index'));
    }

    public function index()
    {
        return view('Reservasi.Index', [
            'pesanan' => Pesanan::latest()->where('kind', 'reservasi')->get(),
            'panel' => ['pesanan', 'reservasi']
        ]);
    }
}
