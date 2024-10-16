<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Order $order;
    public $template;

    public function __construct(User $user, Order $order, $template)
    {
        $this->user = $user;
        $this->order = $order;
        $this->template = $template;
    }

    public function build()
    {
        return $this->subject('Hallo, Adler')
            ->view($this->template); // путь к шаблону письма
    }
}
