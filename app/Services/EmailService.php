<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

class EmailService
{
    private RabbitMQService $rabbitMQService;
    private string $queueName;

    public function __construct(RabbitMQService $rabbitMQService, string $queueName = 'email_queue')
    {
        $this->rabbitMQService = $rabbitMQService;
        $this->queueName = $queueName;
        $this->rabbitMQService->declareQueue($this->queueName);
    }

    public function consume()
    {
        $callback = function ($msg) {
            $data = json_decode($msg->body, true);
            $user = User::find($data['user']);
            $order = Order::find($data['order']);
            $view = $data['view'] ?? 'emails.orderPlaced'; // Используем переданное имя представления

            Mail::to($data['email'])->send(new MyMail($user, $order, $view));
            echo ' [x] Sent email to ', $data['email'], "\n";
        };

        $this->rabbitMQService->getChannel()->basic_consume($this->queueName, '', false, true, false, false, $callback);

        while ($this->rabbitMQService->getChannel()->is_consuming()) {
            $this->rabbitMQService->getChannel()->wait();
        }
    }
}
