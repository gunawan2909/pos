<?php

namespace App\Jobs;

use App\Mail\SendStruk;
use App\Models\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class StruckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $pesanan;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->pesanan = Pesanan::where('id', $id)->get()[0];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mail::to($this->pesanan->email)->send(new SendStruk($this->pesanan->id));
    }
}
