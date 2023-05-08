<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Kelas::create(["name" => "Ibtida'"]);
        Kelas::create(["name" => "Awaliyah"]);
        Kelas::create(["name" => "Wustho"]);
        Kelas::create(["name" => "Aliyah"]);
        Kelas::create(["name" => "Takhfizd"]);
    }
}
