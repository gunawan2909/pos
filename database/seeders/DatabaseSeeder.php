<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jabatan;
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


        Jabatan::create([
            'name' => 'owner',
            'gaji' => 100000
        ]);

        User::create([
            'name' => 'Gunawan Prasetya',
            'email' => 'gunawan29092000@gmail.com',
            'jabatan_id' => 1,
            'password' => bcrypt('@Ind170845')
        ]);
        Menu::create(['name'=> 'Americano','harga'=> '10000','keterangan'=> 'Americano','foto'=> 'menu/YUdzbhQ18frXkgtfjzy6ZmXlCWunhtrrnRaPZWNL.jpg','status'=> NULL,]);
        Menu::create(['name'=> 'Capucino','harga'=> '12000','keterangan'=> 'Capucino','foto'=> 'menu/dlt1sj8j1XpFML9bbzua0iwQvrJ2GLCCmTxWd90P.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Coffee & Lemon','harga'=> '14000','keterangan'=> 'Coffee & Lemon','foto'=> 'menu/DPDyogn3KmGthXQQx5IL32Mxm50oaRGn9Rq3PFd4.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Red Pappy','harga'=> '16000','keterangan'=> 'Red Pappy','foto'=> 'menu/YfIwa2sgJXuuQnKSGMDt3iPFkjuvJlgenoT29kaA.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Fair Lady','harga'=> '18000','keterangan'=> 'Fair Lady','foto'=> 'menu/oFx9acKp7OBsgTWWb9fAhc4iLLoWUkLVfw3N1iup.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Indomie Aceh','harga'=> '12000','keterangan'=> 'Indomie Aceh','foto'=> 'menu/EVzMI3VPjuV7OWUmbpiMyzhwqipfO1drxmBhaRjJ.webp','status'=> '1',]);
        Menu::create(['name'=> 'Ayam Bakar Padang','harga'=> '17000','keterangan'=> 'Sedap dan memiliki Rasa yang kuat','foto'=> 'menu/sEAxBAD0gFXZgj5SqxRfpUAqmgN6K4x03mu4mIyz.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Ayam Sambal Dadu','harga'=> '16000','keterangan'=> 'Enak','foto'=> 'menu/CVTsdnqwxAfoUKTIYesuEzN5ogzN1vDXu6H482m8.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Ayam Geprek','harga'=> '16000','keterangan'=> 'Enak','foto'=> 'menu/lCqQYS2GSyFpdnZFQhnFRuhjQzhrrtdUrYRg5HiF.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Chiken Katsu','harga'=> '15000','keterangan'=> 'Enak','foto'=> 'menu/bxr2rKT60lP0rPFQBUGppIX4dPWcqPwzNWOBdiBm.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Ayam Pop','harga'=> '15000','keterangan'=> 'Enak','foto'=> 'menu/NPT3lltxHq6YJg6HTMopYpuZFAUOUAgfdHA8VRh7.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Ayam Lada Hitam','harga'=> '16000','keterangan'=> 'Enak','foto'=> 'menu/dnGVe1pqwnFjFSV6kPo9kp06XA3NnrCKkUbYnNQI.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Chiken Goehujang','harga'=> '16000','keterangan'=> 'Enak','foto'=> 'menu/j0ZJ0KcQwAFmCD1qXowis063yZlcw0yyocnjwhRD.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Magic Pineapple Squash','harga'=> '13000','keterangan'=> 'Enak','foto'=> 'menu/Qm7AQbybqDsvrxGpeV5B3wU4haMgLb2qt2vmWNWR.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Pandan','harga'=> '14000','keterangan'=> 'Kopi dengan campuran pandan flavour otentik','foto'=> 'menu/H6Supl4BOESWsS5CDtdxqNvqufh1nz5LkEiN2lhf.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopi Tubruk','harga'=> '10000','keterangan'=> 'Kopi yang diolah dengan cara tradisional','foto'=> 'menu/9i3jpQBhPp7OZ2f0yCVyAkrltTZlUYaVLbnrHRZy.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Djadoel','harga'=> '12000','keterangan'=> 'Kopi yang memberi kesan seperti kembali ke jaman dulu','foto'=> 'menu/Gn7jy6DHhM9pKWLuOv8YJd006qqx018ghYQio04U.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Vietnam Drip','harga'=> '12000','keterangan'=> 'Minum kopi berasa seperti di Vietnam','foto'=> 'menu/r60Fkh7TTEZexXvITkmhOoxlot8p4UCTExiyvIM1.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Cappuccino','harga'=> '13000','keterangan'=> 'Enak diminum di pagi hari','foto'=> 'menu/8a5c4UbmehRLyOL3bkXaW9WUspDxKrdX6R0S96XA.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Mochaccino','harga'=> '15000','keterangan'=> 'Sajian cappucino yang ditambahkan dengan cokelat','foto'=> 'menu/ncveKvmrz6HHwrqg1QHpykMC7QgnOcKOSyWy5asw.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Coffee Lemon','harga'=> '15000','keterangan'=> 'Perpaduan rasa gurih kopi dan asam lemon yang pas','foto'=> 'menu/XQP3M46Rj2teQnBE62yDUyDgcNhpb9M3o4F4ca09.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Original','harga'=> '14000','keterangan'=> 'Kopi + susu varian original','foto'=> 'menu/oUgd4EFeDNtDphFIDxgnuE77DKwchpsAItZ6xSAw.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Aren','harga'=> '14000','keterangan'=> 'Kopi susu dengan tambahan gula aren','foto'=> 'menu/axbNYjlbtc9R1KQSq9oDLRIrsR441yRTXhjQhfSY.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Hazelnut','harga'=> '14000','keterangan'=> 'Kopi susu dengan tambahan hazelnut syrup','foto'=> 'menu/CugOUFOwH8eK5rm7fJKaI1by2crXem7DjRFS0O3t.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Caramel','harga'=> '14000','keterangan'=> 'Kopi susu dengan caramel syrup','foto'=> 'menu/rRpfPiA0j9xfqt6SkyF01emKUOQLOlw8Ggddj0U7.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Pandan','harga'=> '14000','keterangan'=> 'Kopi susu dengan syrup pandan','foto'=> 'menu/AnxOU2InlMfRu6ulmK4hZ6xoTvCjmIu8qdTuWSOL.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Kopsu Banana','harga'=> '14000','keterangan'=> 'Kopi susu dengan banana flavour','foto'=> 'menu/jLGMeTEvBpKipRh6pSwqv5kCiHabOAtAbPdbeyL4.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Fairy Lady','harga'=> '14000','keterangan'=> 'Minuman segar cocok diminum siang hari','foto'=> 'menu/aLSbDA1QBGX2BcWmpDYqEwhsUi0Vxjc595V4fzox.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Pineapple Booster','harga'=> '14000','keterangan'=> 'Minuman sehat dari buah nanas','foto'=> 'menu/gw81WVfEpPz1SnuZzLZCo8rTTqH13mhKzY3PZPni.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Red Pappy','harga'=> '14000','keterangan'=> 'Minuman pelepas dahaga','foto'=> 'menu/Ag6u1QIOEakyISUPBaeNSoriuptIXceBiUIWyhit.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Chicken Pop','harga'=> '15000','keterangan'=> 'Olahan ayam dengan resep sempurna','foto'=> 'menu/xQ96u4kWrzYIGfysDJ2sBspdFlpc1I3movuDzATI.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Chicken Ghocujang','harga'=> '16000','keterangan'=> 'Ayam dengan olahan pedas bumbu korea','foto'=> 'menu/mSVKUiyur5WucZLtIcFmrbX6tqZtSw5KsJCiW4PE.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Chicken Katsu','harga'=> '15000','keterangan'=> 'Olahan ayam katsu','foto'=> 'menu/nl7HZu1cqcsgnniIgsEK61RKZDCqu8q1WdaVvWMp.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Mie Goreng Telur Katsu','harga'=> '17000','keterangan'=> 'Lezat','foto'=> 'menu/OfSa7ZIfWxU4kcUfi5TTqwfuCxe7XP1MJvyzm59Z.webp','status'=> '1',]);
        Menu::create(['name'=> 'Mie Setan','harga'=> '9000','keterangan'=> 'Mie level murah meriah','foto'=> 'menu/c06NeOCYIK4mneQXruOfkFZJSCUtT8rfSywhimjZ.jpg','status'=> '1',]);
        Menu::create(['name'=> 'Indomie Aceh','harga'=> '8000','keterangan'=> 'Mie instan varian mie aceh','foto'=> 'menu/ej1MbnK4v3pNRGHK4aiAJkIH2bNeqTQ1RL5pOrDb.jpg','status'=> '1',]);
       
    }
