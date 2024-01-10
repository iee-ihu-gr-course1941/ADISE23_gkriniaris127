<?php
// Create WebSocket server
$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($server, '0.0.0.0', 8888); // Replace with your desired IP and port
socket_listen($server);

echo "Server started\n";

// Accept incoming connections
$client = socket_accept($server);
echo "Client connected\n";

// Read data from the client
$input = socket_read($client, 1024);
echo "Received message from client: " . $input . "\n";

// Send a message back to the client
socket_write($client, "Hello Client!");

// Close the socket connection
socket_close($client);
socket_close($server);
?>
