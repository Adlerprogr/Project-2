<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private AMQPStreamConnection $connection;
    private $channel;

    public function __construct(string $host = 'rabbitmq', int $port = 5672, string $user = 'guest', string $password = 'guest')
    {
        $this->connection = new AMQPStreamConnection($host, $port, $user, $password);
        $this->channel = $this->connection->channel();
    }

    public function declareQueue(string $queueName)
    {
        $this->channel->queue_declare($queueName, false, false, false, false);
    }

    public function publishMessage(string $queueName, array $data)
    {
        $msg = new AMQPMessage(json_encode($data));
        $this->channel->basic_publish($msg, '', $queueName);
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function sendEmail(string $queueName, string $email, int $userId, string $view, array $data = [])
    {
        $data = array_merge($data, [
            'email' => $email,
            'user' => $userId,
            'view' => $view
        ]);

        $this->publishMessage($queueName, $data);
    }
}
