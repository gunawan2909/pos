<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function provinsi()
    {
        $wilayah = new Wilayah();
        return $wilayah->data('provinsi');
    }
    public function kabupaten(Request $request)
    {
        $wilayah = new Wilayah();
        echo  '<option value="" >Pilih Kabupaten</option>';
        foreach ($wilayah->data('kabupaten', $request->code) as $item) {
            echo  "<option value=" . $item->code . ">" . $item->name . "</option>";
        };
    }
    public function kecamatan(Request $request)
    {
        $wilayah = new Wilayah();
        echo  '<option value="" >Pilih Kecamatan</option>';
        foreach ($wilayah->data('kecamatan', $request->code) as $item) {
            echo  "<option value=" . $item->code . ">" . $item->name . "</option>";
        };
    }
    public function desa(Request $request)
    {
        $wilayah = new Wilayah();
        echo  '<option value="" >Pilih Desa</option>';
        foreach ($wilayah->data('desa', $request->code) as $item) {
            echo  "<option value=" . $item->code . ">" . $item->name . "</option>";
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wilayah $wilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wilayah $wilayah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wilayah $wilayah)
    {
        //
    }
}
