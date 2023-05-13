<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersediaanList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function persediaan()
    {
        return  $this->hasOne(Persediaan::class, 'id', 'persediaan_id')->withTrashed();
    }
}
