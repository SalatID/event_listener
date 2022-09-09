<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Enqueue\AmqpBunny\AmqpConnectionFactory;
use Interop\Amqp\AmqpQueue;
use Interop\Queue\Message;
use Interop\Queue\Consumer;

class NotifikasiController extends Controller
{
    protected $factory;
    protected $context;
    function __construct()
    {
        $this->factory = new AmqpConnectionFactory( [
            'host' => '192.168.50.70',
            'port' => 5672,
            'vhost' => '/',
            'user' => 'adb_user',
            'pass' => 'adb_user',
            'persisted' => false,
        ]);
        $this->context = $this->factory->createContext();
        // dd($this->factory);
    }
    public function test()
    {
        
        #queue
        $queue = 'bca';
        $barQueue = $this->context->createQueue($queue);
        $barQueue->addFlag(AmqpQueue::FLAG_DURABLE);
        $this->context->declareQueue($barQueue);
 
        $barConsumer = $this->context->createConsumer($barQueue);
 
        $subscriptionConsumer = $this->context->createSubscriptionConsumer();
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
            var_dump($message->getBody());
            $consumer->acknowledge($message);
 
            return true;
        });
 
        $subscriptionConsumer->consume(); 
 
        die('done');
    }
}
