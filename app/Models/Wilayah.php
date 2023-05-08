<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wilayah extends Model
{
    use HasFactory;


    public function data($kind, $code = null)
    {
        if ($kind == 'provinsi') {
            return DB::table('wilayahs')->whereRaw('CHAR_LENGTH(code)=2')->get();
        } elseif ($kind == 'kabupaten') {
            return DB::table('wilayahs')->whereRaw('LEFT(code,2)=' . $code . ' AND CHAR_LENGTH(code)=5')->get();
        } elseif ($kind == 'kecamatan') {
            return DB::table('wilayahs')->whereRaw('LEFT(code,5)=' . $code . ' AND CHAR_LENGTH(code)=8')->get();
        } elseif ($kind == 'desa') {
            return DB::table('wilayahs')->whereRaw('LEFT(code,8)="' . $code . '" AND CHAR_LENGTH(code)=13')->get();
        }
    }
}
