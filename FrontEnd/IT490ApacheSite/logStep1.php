<?php
require_once '/home/neil/IT490/IT490/FrontEnd/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//$payload = 'Hello World!';
//$username = $_POST['username'];
//$password = $_POST['password'];
//$email = $_POST['email'];


$password = 'ZuCOZUCO1!';
$username = 'ZUCOZUCO';


// Create a connection to RabbitMQ
$connection = new AMQPStreamConnection('192.168.191.111', 5672, 'admin', 'admin');
$channel = $connection->channel();

// Declare a queue for sending messages
$channel->queue_declare('logFE2BE', false, false, false, false);

// Publish the message to the queue
$messageBody = json_encode
(
	[
    		'password' => $password,
		'username' => $username
	]
);

// Define the message to send
$message = new AMQPMessage($messageBody);

// Publish the message to the queue
$channel->basic_publish($message, '', 'logFE2BE');

//Echo Msg to console
echo "-={[Front-end] Sent message to the Back-end!}=-\n$messageBody\n";

// Close the channel and the connection
$channel->close();
$connection->close();
?>

