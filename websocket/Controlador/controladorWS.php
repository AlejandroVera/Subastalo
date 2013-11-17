<?php
namespace Controlador;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ControladorWS implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        echo "Conectado con ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Conexion %d envia el texto: "%s" a %d ortas conexiones%s' . "\n"
            , $from->resourceId, $msg, $numRecv);

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        echo "La conexion con  {$conn->resourceId} ha terminado\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Alerta Error: {$e->getMessage()}\n";

        $conn->close();
    }
}