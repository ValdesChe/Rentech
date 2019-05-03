<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Reservation;
use App\User;
class CancelEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $whoCanceled;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, User $whoCanceled)
    {
        $this->reservation = $reservation;
        $this->whoCanceled = $whoCanceled;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.cancelemail');
    }
}