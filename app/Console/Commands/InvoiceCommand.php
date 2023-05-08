<?php

namespace App\Console\Commands;

use App\Models\InvoiceCreartor;
use Illuminate\Console\Command;

class InvoiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InvoiceCommand';

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
        $invoice = new InvoiceCreartor();

        
        foreach ($invoice->where('') as $item){

        }

    }
}
