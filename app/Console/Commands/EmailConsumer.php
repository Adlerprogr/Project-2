<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class EmailConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume email messages from RabbitMQ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('email_queue', false, false, false, false);

        $callback = function ($msg) {
            $data = json_decode($msg->body, true);
//            dd($data);
            $user = $data['user'];
            $order = $data['order'];

            Mail::to($data['email'])->send(new MyMail($user, $order, 'emails.orderPlaced'));
            echo ' [x] Sent email to ', $data['email'], "\n";
        };

        $channel->basic_consume('email_queue', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
