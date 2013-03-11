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

    /**
     * All players
     * @var Player\Storage
     */
    protected $players;

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
        $this->game->addPlayer(new Player($conn));

        echo "Added player! ({$conn->resourceId})\n";
    }

    /**
     * On message from client
     * @param \Ratchet\ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo 'Sending: '.$msg.PHP_EOL;
        $player = $this->players->getPlayerByConnection($from);
        $game = $player->getGame();
        foreach ($game->getPlayers() as $client) {
            if ($player !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->getConnection()->send($msg);
            }
        }
    }

    /**
     * Destroy player and all references
     * @param \Ratchet\ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->destroyPlayer($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    /**
     * On connection error
     * @param \Ratchet\ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $this->destroyPlayer($conn);
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    /**
     * Destroy player and all references
     * @param \Ratchet\ConnectionInterface $conn
     */
    public function destroyPlayer($conn)
    {
        $player = $this->players->getPlayerByConnection($conn);
        $game = $player->getGame();
        $game->removePlayer($player);
        $this->players->removePlayer($player);
        unset($player);
    }
}
