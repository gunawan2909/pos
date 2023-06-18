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
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
            ->when($filters['status'] ?? false, function ($query, $status) {
                return $query->where('status',  $status);
            });;
    }
}
