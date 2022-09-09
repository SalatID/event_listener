<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
 
use Enqueue\AmqpBunny\AmqpConnectionFactory;
use Interop\Amqp\AmqpQueue;
 
use Interop\Queue\Message;
use Interop\Queue\Consumer;
use  App\Events\NotifikasiEvent;
use  App\Events\NotifikasiDuaEvent;
use  App\Events\NotifikasiTigaEvent;
use Queue;

class Subscribe extends Command
{
   /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:data';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an consume data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $config = [
            'host' => '192.168.50.70',
            'port' => 5672,
            'vhost' => '/',
            'user' => 'adb_user',
            'pass' => 'adb_user',
            'persisted' => false,
        ];

        $factory = new AmqpConnectionFactory($config);

        $context = $factory->createContext();

        // #queue
        // $queue = 'bni';
        // $fooQueue = $context->createQueue($queue);
        // $fooQueue->addFlag(AmqpQueue::FLAG_DURABLE);
        // $context->declareQueue($fooQueue);

        #queue
        $queue = 'bca';
        $barQueue = $context->createQueue($queue);
        $barQueue->addFlag(AmqpQueue::FLAG_DURABLE);
        $context->declareQueue($barQueue);

        // $consumer = $context->createConsumer($fooQueue);
        $barConsumer = $context->createConsumer($barQueue);

        $subscriptionConsumer = $context->createSubscriptionConsumer();
        // $subscriptionConsumer->subscribe($consumer, function(Message $message, Consumer $consumer) {
        //     // process message
        //     echo "foo consumer: ";
        //     var_dump($message->getBody());

        //     $consumer->acknowledge($message);

        //     return true;
        // });
        
        $subscriptionConsumer->subscribe($barConsumer, function(Message $message, Consumer $consumer) {
            // process message

            echo "bar consumer: ";
            Queue::push(new \App\Jobs\TestJob);
            event(new NotifikasiEvent($message->getBody()));
            // event(new NotifikasiDuaEvent($message->getBody()));
            // event(new NotifikasiTigaEvent($message->getBody()));
            var_dump($message->getBody());
            $consumer->acknowledge($message);

            return true;
        });

        $subscriptionConsumer->consume(); 

        die('done');
    }
}
