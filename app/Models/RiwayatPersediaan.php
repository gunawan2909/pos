<?php

namespace App\Models;

use App\Models\Transaksi;
use App\Models\Persediaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPersediaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function persediaan()
    {
        return $this->hasOne(Persediaan::class, 'id', 'persediaan_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id', 'transaksi_id');
    }
}
