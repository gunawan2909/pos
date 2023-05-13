<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function menu()
    {
        return  $this->hasOne(Menu::class, 'id', 'menu_id')->withTrashed();
    }
}
