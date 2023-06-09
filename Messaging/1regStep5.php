<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// Create a connection to RabbitMQ
$connection = new AMQPStreamConnection('192.168.191.111', 5672, 'admin', 'admin');
$channel = $connection->channel();

// Declare the queue
$channel->queue_declare('regBE2FE', false, false, false, false);

echo "-={[FrontEnd] Waiting for Back-end messages. To exit press CTRL+C}=-\n";

// Define the callback function to process messages from the queue
$callback = function ($message) use ($channel){
	echo "Received message from Back-end: " . $message->body . "\n";
        
	$data = json_decode($message->getBody(), true);
	
	$isValid = $data['isValid'];
	$userExists = $data['userExists'];

	if ($isValid == false)
        {
		echo "\n[Incorrect format for Registration Info]\n";

		//TODO for Neil: Redirects Page

        }


        if ($isValid == true)
        {
                $userExists = $data['userExists'];

                //echo "The value of userAuth is: " . $userExists . "\n";

                if ($userExists == false){
			echo "\nSuccessfully Registered!\n";

			//TODO for Neil: Redirects Page

                } else {
			echo "\nUsername / Email is already taken!\n";

			//TODO for Neil: Redirects Page
                }
	}
	
};

// Consume messages from the queue
$channel->basic_consume('regBE2FE', '', false, true, false, false, $callback);

echo "\n[Before wait!]\n\n";

// Keep consuming messages until the channel is closed
while ($channel->is_open()) {
	$channel->wait();
	echo "\n[Wait!]\n";
	break;
}



// Close the connection
$channel->close();
$connection->close();

