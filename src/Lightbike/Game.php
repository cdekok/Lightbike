<?php
namespace Lightbike;

use React\Socket\ConnectionInterface;
use SplObjectStorage;

/**
 * Game
 */
class Game
{

    /**
     * Object containing all clients
     *
     * @var SplObjectStorage
     */
    protected $players;

    /**
     * Game is started
     * @var boolean
     */
    protected $started = false;

    /**
     * Maximum amount of players in the game
     * @var integer
     */
    protected $maxPlayers;

    /**
     * Construct
     * @param integer $maxPlayers
     */
    public function __construct($maxPlayers = 4)
    {
        $this->maxPlayers = $maxPlayers;
        $this->players = new SplObjectStorage($maxPlayers);
    }

    /**
     * Get started
     * @return boolean
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Start game
     * @param boolean $started
     * @return \Lightbike\Game
     */
    public function setStarted($started)
    {
        $this->started = $started;
        return $this;
    }

    /**
     * Get all players
     * @return \SplObjectStorage
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add player
     * @param \React\Socket\ConnectionInterface $player
     */
    public function addPlayer(ConnectionInterface $player)
    {
        $this->players->attach($player);
    }

    /**
     * Remove player
     * @param \React\Socket\ConnectionInterface $player
     */
    public function removePlayer(ConnectionInterface $player)
    {
        $this->players->detach($player);
    }
}
