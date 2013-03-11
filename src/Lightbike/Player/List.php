<?php
namespace Lightbike\Player;

use Lightbike\Player;
use React\Socket\ConnectionInterface;

/**
 * Object containing all players
 */
class Storage
{
    /**
     * Hashmap of all players
     * @var array
     */
    private $players = array();

    /**
     * Add player
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[$player->getConnection()->resourceId] = $player;
    }

    /**
     * Remove player
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        unset($this->players[$player->getConnection()->resourceId]);
    }

    /**
     * Get player by open connection
     * @param \React\Socket\ConnectionInterface $connection
     * @return Player
     */
    public function getPlayerByConnection(ConnectionInterface $connection)
    {
        return $this->players[$connection->resourceId];
    }
}
