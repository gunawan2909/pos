<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function list()
    {
        return $this->hasMany(PesananList::class, 'pesanan_id', 'id');
    }
}
