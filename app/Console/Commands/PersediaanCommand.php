<?php

namespace App\Console\Commands;

use App\Models\Persediaan;
use Illuminate\Console\Command;

class PersediaanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:persediaan-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        foreach (Persediaan::all() as $persediaan) {
            if ($persediaan->satuan == 'ml') {
                if ($persediaan->jumlah < 500) {
                    foreach ($persediaan->list as $list) {
                        foreach ($list->menu as $menu) {
                            $menu->update(['status' => 0]);
                        }
                    }
                }
            }
            if ($persediaan->satuan == 'kg') {
                if ($persediaan->jumlah < 5000) {
                    foreach ($persediaan->list as $list) {
                        foreach ($list->menu as $menu) {
                            $menu->update(['status' => 0]);
                        }
                    }
                }
            }
            if ($persediaan->satuan == 'pcs') {
                if ($persediaan->jumlah < 50) {
                    foreach ($persediaan->list as $list) {
                        foreach ($list->menu as $menu) {
                            $menu->update(['status' => 0]);
                        }
                    }
                }
            }
        }
    }
}
