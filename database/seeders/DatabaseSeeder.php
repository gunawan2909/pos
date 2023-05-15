<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\kas;
use App\Models\Menu;
use App\Models\Persediaan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        kas::create(['name' => 'tunai', 'nominal' => 0]);
        kas::create(['name' => 'non tunai', 'nominal' => 0]);
        Persediaan::create([
            'name' => 'Gula',
            'jumlah' => 10,
            'satuan' => 'gram'
        ]);
        Persediaan::create([
            'name' => 'Teh',
            'jumlah' => 10,
            'satuan' => 'gram'
        ]);


        User::create([
            'name' => 'Gunawan Prasetya',
            'email' => 'gunawan29092000@gmail.com',
            'password' => bcrypt('@Ind170845')
        ]);
    }
}
