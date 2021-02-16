<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Bonus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_whom, $sum)
    {
        $this->from_whom = $from_whom;
        $this->sum = $sum;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Новый запрос о выводе бонусных ссредств')->view(
            'mails.bonus',
            [
                'from_whom' => $this->from_whom,
                'sum' => $this->sum
            ]
        );
    }
}
