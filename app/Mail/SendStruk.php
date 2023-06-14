<?php

namespace App\Mail;

use App\Models\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStruk extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $total;
    public $pesanan;
    /**
     * Create a new message instance.
     */
    public function __construct($id)
    {
        $total = 0;
        $pesanan = Pesanan::where('id', $id)->get()[0];
        foreach ($pesanan->list as $item) {
            $total += ($item->menu->harga * $item->jumlah);
        }
        $this->pesanan = Pesanan::where('id', $id)->get()[0];
        $this->total = $total;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Struk',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            view: 'Pesanan.Status',
            with: [

                $this->pesanan,
                $this->total
            ]


        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
