<?php
namespace Lightbike;

use React\Socket\ConnectionInterface;

class Player
{

    /**
     * Player connection
     * @var \React\Socket\ConnectionInterface
     */
    protected $connection;

    /**
     * Color of player
     * @var string
     */
    protected $color;

    /**
     * Currently active game
     * @var Game
     */
    protected $game;

    /**
     * Construct
     * @param \React\Socket\ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get player connection
     * @return \React\Socket\ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Get player color
     * @return string
     */
    public function getColor()
    {
        return $this->color;

    }

    /**
     * Set player color
     * @param string $color
     * @return \Lightbike\Player
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;

    }

    /**
     * Get currently active game
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set player active game
     * @param \Lightbike\Game $game
     * @return \Lightbike\Player
     */
    public function setGame(Game $game)
    {
        $this->game = $game;
        return $this;
    }
}
