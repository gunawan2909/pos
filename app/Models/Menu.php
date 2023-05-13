<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function persediaan()
    {
        return $this->hasMany(PersediaanList::class, 'menu_id', 'id');
    }
}
