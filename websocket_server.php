<?php
session_start();
$id = $_SESSION['user_id'];
require "./vendor/autoload.php";
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
class WebSocketServer implements MessageComponentInterface
{
    protected $clients;
    protected $id;
  
    public function __construct($id)
    {
        $this->clients = new \SplObjectStorage();
        $this->id = $id;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        var_dump($conn);
        echo "New connection! ({$conn->id})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }
    }
    
    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->id} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Set up the WebSocket server
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocketServer($id)
        )
    ),
    5001
);

$server->run();