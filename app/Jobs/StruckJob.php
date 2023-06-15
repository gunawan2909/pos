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
    public $id;
    public $email;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = Pesanan::where('id', $id)->get()[0]->id;
        $this->email = Pesanan::where('id', $id)->get()[0]->email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $email = Pesanan::where('id', 1)->get()[0]->email;
        // $id = Pesanan::where('id', 1)->get()[0]->id;
        Mail::to($this->email)->send(new SendStruk($this->id));
        // Mail::to('gunawan@gmail.com')->send(new SendStruk(16));

        // Mail::to($this->email)->send(new SendStruk($this->id));
    }
}
