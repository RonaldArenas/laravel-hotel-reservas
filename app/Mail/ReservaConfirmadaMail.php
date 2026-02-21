<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ReservaConfirmadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;
    public $usuario;

    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
        $this->usuario = Auth::user(); // 👈 usuario logueado
    }

    public function build()
    {
        return $this
            ->subject('Reserva confirmada - Hotel Naturaleza')
            ->view('emails.reserva-confirmada')
            ->with([
                'reserva' => $this->reserva,
                'usuario' => $this->usuario,
            ]);
    }
}