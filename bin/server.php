<?php
/**
 * Run this to start the Lightbike server
 */
require_once '../vendor/autoload.php';

use Lightbike\Server;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new WsServer(new Server())
    ,8080
);

$server->run();