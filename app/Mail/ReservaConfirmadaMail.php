<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaConfirmadaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Datos de la reserva
     */
    public $reserva;

    /**
     * Crear una nueva instancia del mensaje
     */
    public function __construct($reserva)
    {
        $this->reserva = $reserva;
    }

    /**
     * Construir el mensaje
     */
    public function build()
    {
        return $this->subject('Confirmación de Reserva - Hotel Naturaleza')
                    ->view('emails.reserva-confirmada');
    }
}