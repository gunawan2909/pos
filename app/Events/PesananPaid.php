<?php

namespace App\Events;

use App\Models\Pesanan;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PesananPaid implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $pesan_id;
    /**
     * Create a new event instance.
     */
    public function __construct($pesan_id)
    {
        $this->pesan_id = $pesan_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('pesanan'),
        ];
    }
    public function broadcastWith()
    {
        return [
            'data' => $this->data()
        ];
    }

    private function data()
    {
        $pesanan = Pesanan::where('id', $this->pesan_id)->get()[0];
        $html = '  <div class=" bg-white border-y-2 p-2 my-3 rounded-md">
        <div class="flex">
            <div class=" flex">
                <p class=" w-24">Atas Nama</p>
                <p>: ' . $pesanan->name . '</p>
            </div>
            <form action="" method="post" class=" ml-auto mr-2"><input type="hidden" value="' . csrf_token() . '">
            
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4l4.25 4.25ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                    </svg>
                </button>
            </form>

        </div>';
        foreach ($pesanan->list as $item) {
            $html = $html . '
            <div class="flex my-3 border-y-2 p-1 ">
                <img class="w-24 rounded-md " src="' . asset($item->menu->foto) . '" alt="">
                <div class="ml-3">
                    <p>' . $item->menu->name . '</p>
                    <p class=" text-xs">Catatan Khusus : <span class="font-semibold">' . $item->keterangan . '</span>
                    </p>
                    <p class="font-bold">' . $item->jumlah . '</p>
                </div>
            </div>';
        }

        $html = $html . '</div>';
        return $html;
    }
}
