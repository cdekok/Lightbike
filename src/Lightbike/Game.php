<?php
namespace Lightbike;

use React\Socket\ConnectionInterface;

/**
 * Game
 */
class Game
{

    /**
     * Object containing all clients
     * hashmap created from player connection id
     *
     * @var array
     */
    protected $players = [];

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
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add player
     * @param \Lightbike\Player
     * @throws Lightbike\Game\FullException
     */
    public function addPlayer(Player $player)
    {
        if ($this->isFull()) {
            throw new Game\FullException('Game is full');
        }
        // Set currently active game
        $player->setGame($this);
        $this->players[$player->getConnection()->resourceId] = $player;
    }

    /**
     * Remove player
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        unset($this->players[$player->getConnection()->resourceId])
    }

    /**
     * Check if game is full to allow new players
     * @return boolean
     */
    public function isFull()
    {
        if (count($this->players) === $this->maxPlayers) {
            return true;
        }
        return false;
    }

    /**
     * Get random color
     * @return string
     */
    public function getRandomColor()
    {
        $color = sprintf(
            "#%x%x%x",
            rand(0, 255),
            rand(0, 255),
            rand(0, 255)
        );
        return $color;
    }
}
