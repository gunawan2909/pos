<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function persediaan()
    {
        return $this->hasMany(PersediaanList::class, 'menu_id', 'id');
    }
}
