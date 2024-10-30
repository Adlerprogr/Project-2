<?php

namespace App\Jobs;

use App\Mail\MyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;
    public array $data;
    public string $template;

    public function __construct(string $email, array $data, string $template)
    {
        $this->email = $email;
        $this->data = $data;
        $this->template = $template;
    }

    public function handle()
    {
        try {
            Mail::to($this->email)->send(new MyMail($this->data, $this->template));
        } catch (\Exception $e) {
            Log::error("Ошибка отправки email: " . $e->getMessage());
        }
    }
}
