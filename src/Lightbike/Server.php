<?php

/*
 * Lightbike server
 *
 * @package Lightbike
 */

namespace Lightbike;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/**
 * Server class use this to run a gaming server :)
 *
 * @author Chris de Kok
 */
class Server implements MessageComponentInterface
{

    /**
     * Object containing all clients
     *
     * @var Game
     */
    protected $game;

    public function __construct()
    {
        $this->game = new Game();
    }

    /**
     * Add player to the game on new connection
     * @param \Ratchet\ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->game->addPlayer($conn);

        echo "Added player! ({$conn->resourceId})\n";
    }


    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->game->getPlayers()) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        foreach ($this->game->getPlayers() as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->game->removePlayer($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
