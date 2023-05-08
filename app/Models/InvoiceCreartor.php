<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceCreartor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {

            return $query->where('name', 'like', '%' . $search . '%')

                ->orwhere('keterangan', 'like', '%' . $search . '%')
                ->orwhere('period', 'like', '%' . $search . '%')
                ->orwhere('jumlah', 'like', '%' . $search . '%')
                ->orwhere('kepada', 'like', '%' . $search . '%');
        });
    }
}
