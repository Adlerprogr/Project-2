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

    protected string $email;
    protected array $data;
    protected string $template;

    public function __construct(string $email, array $data, string $template)
    {
        $this->email = $email;
        $this->data = $data;
        $this->template = $template;
    }

    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new MyMail($this->data, $this->template));
            Log::info("Email '{$this->template}' успешно отправлен на адрес '{$this->email}'");
        } catch (\Exception $e) {
            Log::error("Ошибка отправки email '{$this->template}' на адрес '{$this->email}': " . $e->getMessage());
        }
    }
}
