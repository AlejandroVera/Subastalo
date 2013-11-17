<?php
use Ratchet\Wamp\WampServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Pusher;

    require dirname(__DIR__) . '/vendor/autoload.php';

    $server = IoServer::factory(
        new WsServer(
            new WampServer(
			new Pusher()
			)
        )
      , 8080
    );

    $server->run();