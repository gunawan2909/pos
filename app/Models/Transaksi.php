<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('keterangan', 'like', '%' . request('search') . '%')
                ->orwhere('status', 'like', '%' . request('search') . '%')
                ->orwhere('metode', 'like', '%' . request('search') . '%')
                ->orwhere('kind', 'like', '%' . request('search') . '%');
        })
            ->when($filters['kind'] ?? false, function ($query, $kind) {
                return $query->where('kind', 'like', '%' . request('kind') . '%');
            })
            ->when($filters['metode'] ?? false, function ($query, $metode) {
                return $query->where('metode', 'like', '%' . request('metode') . '%');
            });
    }
}
