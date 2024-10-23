<?php

namespace App\Console\Commands;

use App\Services\EmailService;
use App\Services\RabbitMQService;
use Illuminate\Console\Command;

class EmailConsumer extends Command
{
    protected $signature = 'email:consume {queueName=email_queue}';
    protected $description = 'Consume email messages from RabbitMQ';

    public function handle()
    {
        $queueName = $this->argument('queueName');
        $rabbitMQService = new RabbitMQService(); // Используем стандартные настройки
        $emailService = new EmailService($rabbitMQService, $queueName);
        $emailService->consume();
    }
}
