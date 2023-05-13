<?php

namespace App\Http\Controllers;

use App\Models\kas;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Events\PesananPaid;
use App\Models\PesananList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Cache\Store;

class PesananController extends Controller
{
    public function add()
    {
        return view('Pesanan.Registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([]);
        $data = $request->validate([
            'name' => 'required',
            'jumlah' => 'required',
        ]);
        $data['status'] = 'Unpaid';
        $data['date'] = now();
        $data['time'] = now();
        $data['no_wa'] = "-";
        $data['kind'] = "no_reservasi";

        $pesanan = Pesanan::create($data);
        return redirect(route('pesanan.list', ['id' => $pesanan->id]));
    }


    public function create($id)
    {
        return view('Pesanan.List', [
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

    public function invoice($id)
    {
        $snapToken = "";
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $total = 0;

        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        if ($pesanan->status == 'Unpaid') {
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

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
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        }

        return view('Pesanan.Invoice', [
            'pesanan' => Pesanan::where('id', $id)->get()[0],
            'total' => $total,
            'snapToken' => $snapToken
        ]);
    }
    public function invoiceSeller($id)
    {
        $pesanan = Pesanan::where('id', $id)->get()[0];
        $total = 0;

        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        $snapToken = '';
        if ($pesanan->status != 'Paid') {

            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
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

            $snapToken = \Midtrans\Snap::getSnapToken($params);
        }
        return view('Pesanan.InvoiceSeller', [
            'pesanan' => Pesanan::where('id', $id)->get()[0],
            'total' => $total,
            'snapToken' => $snapToken
        ]);
    }

    public function pay($id)
    {
        $total = 0;
        $pesanan = Pesanan::where('id', $id)->get()[0];
        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        $total = $total;
        Pesanan::where('id', $id)->update(['status' => 'Paid']);
        $kas = kas::where('name', 'tunai')->get()[0]->nominal  +  $total;
        kas::where('name', 'tunai')->update(['nominal' => $kas]);
        event(new PesananPaid($id));

        return redirect(route('pesanan.pesanan.index'));
    }
    public function payCustomer($id)
    {
        return view('Pesanan.PayCustomer', [
            'urlback' => route('pesanan.invoice', ['id' => $id])
        ]);
    }


    public function callbackpayout(Request $request)
    {
        $serverKey = config('midtrans.serverKey');


        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $data = explode('-', $request->order_id);
                if ($data[0] == 'dp') {
                    $pesanan = Pesanan::where('id', $data[1])->get();
                    Pesanan::where('id', $data[1])->update(['status' => 'Down Payment Paid']);
                    $massage = 'Ini Link bukti pembayaran anda  *' .  route('pesanan.reservasi.status', ['id' => $data[1]])  . '* untuk tindakan keamanan tambahan. Mohon tidak menyebarkannya. Terima kasih atas perhatian Anda.';
                    Http::post('https://ppnh.co.id:2053/send-message', ['number' => $pesanan[0]->no_wa, 'message' => $massage]);
                }
                if ($data[0] == 'po') {
                    Pesanan::where('id', $data[1])->update(['status' => 'Paid']);
                    event(new PesananPaid($data[1]));
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

    public function index()
    {
        return view('Pesanan.Index', [
            'pesanan' => Pesanan::latest()->where('kind', 'no_reservasi')->get(),
            'panel' => ['pesanan', 'no_reservasi']
        ]);
    }

    public function monitoring()
    {
        return view('Pesanan.Monitoring', [
            'panel' => ['pesanan', 'monitoring'],
            'pesanans' => Pesanan::where('status', 'Paid')->get(),
        ]);
    }
    public function complited($id)
    {
        $pesanan = Pesanan::where('id', $id)->get()[0];
        foreach ($pesanan->list as $list) {
            foreach ($list->menu->persediaan as $persediaanlist) {
                $jumlah =  $persediaanlist->persediaan->jumlah - $persediaanlist->jumlah * $list->jumlah;
                $persediaanlist->persediaan->update(['jumlah' => $jumlah]);
            }
        }
        Pesanan::where('id', $id)->update(['status' => 'Complited']);
        return back();
    }
}
