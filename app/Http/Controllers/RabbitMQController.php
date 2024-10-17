<?php

namespace App\Http\Controllers;

//use PhpAmqpLib\Connection\AMQPStreamConnection;
//use PhpAmqpLib\Message\AMQPMessage;
//
//class RabbitMQController extends Controller
//{
//    public function sendMessage()
//    {
//        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
//        $channel = $connection->channel();
//
//        $channel->queue_declare('hello', false, false, false, false);
//
//        $msg = new AMQPMessage('Hello World!');
//        $channel->basic_publish($msg, '', 'hello');
//
//        echo " [x] Sent 'Hello World!'\n";
//
//        $channel->close();
//        $connection->close();
//    }
//
//    public function receiveMessage()
//    {
//        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
//        $channel = $connection->channel();
//
//        $channel->queue_declare('hello', false, false, false, false);
//
//        echo " [*] Waiting for messages. To exit press CTRL+C\n";
//
//        $callback = function ($msg) {
//            echo ' [x] Received ', $msg->body, "\n";
//        };
//
//        $channel->basic_consume('hello', '', false, true, false, false, $callback);
//
//        try {
//            $channel->consume();
//        } catch (\Throwable $exception) {
//            echo $exception->getMessage();
//        }
//
//        $channel->close();
//        $connection->close();
//    }
//}

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQController extends Controller
{
    public function sendMessage()
    {
        try {
            $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
            $channel = $connection->channel();

            $channel->queue_declare('hello', false, false, false, false);

            $msg = new AMQPMessage('Hello World!');
            $channel->basic_publish($msg, '', 'hello');

            echo " [x] Sent 'Hello World!'\n";

            $channel->close();
            $connection->close();
        } catch (\Throwable $e) {
            echo "Error sending message: " . $e->getMessage() . "\n";
        }
    }

    public function receiveMessage()
    {
        try {
            $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
            $channel = $connection->channel();

            $channel->queue_declare('hello', false, false, false, false);

            echo " [*] Waiting for messages. To exit press CTRL+C\n";

            $callback = function ($msg) {
                echo ' [x] Received ', $msg->body, "\n";
            };

            $channel->basic_consume('hello', '', false, true, false, false, $callback);

            $channel->wait(null, false); // Используйте бесконечный таймаут для бесконечного ожидания

            $channel->close();
            $connection->close();
        } catch (\Throwable $e) {
            echo "Error receiving message: " . $e->getMessage() . "\n";
        }
    }
}
