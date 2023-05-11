<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
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
            'jumlah' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $data['status'] = 'Unpaid';

        $pesanan = Pesanan::create($data);
        return redirect(route('pesanan.reservasi.list', ['id' => $pesanan->id]));
    }


    public function create($id)
    {
        return view('Reservasi.List', [
            'pesanan' => Pesanan::where('id', $id)->get()[0],
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
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $total = 0;

        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        $total = $total / 2;
        $params = array(
            'transaction_details' => array(
                'order_id' => "pd-" . $pesanan->id,
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
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $total = 0;

        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        $params = array(
            'transaction_details' => array(
                'order_id' => "po-" . $pesanan->id,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $pesanan->name,
                'last_name' => '',

                'phone' => $pesanan->no_wa,
            ),
        );
        $total = $total / 2;
        $snapToken = \Midtrans\Snap::getSnapToken($params);
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
        return view('Reservasi.Reservasi', [
            'pesanan' => Pesanan::where('id', $id)->get()[0]
        ]);
    }

    public function index()
    {
        return view('Reservasi.Index', [
            'pesanan' => Pesanan::where('status', '<>', 'Paid')->get(),
            'panel' => ['', '']
        ]);
    }
}
