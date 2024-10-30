<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public string $template;

    public function __construct(array $data, string $template)
    {
        $this->data = $data; // Передаем массив с данными
        $this->template = $template; // Название шаблона
    }

    public function build()
    {
        return $this->subject('Notification') // Можно сделать subject динамическим
            ->view($this->template)
            ->with($this->data);
    }
}
