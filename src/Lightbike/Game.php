<?php
namespace Lightbike;

class Game
{
    /**
     * Game is started
     * @var boolean
     */
    protected $started = false;
  
    /**
     * players
     * 
     * @var \SplFixedArray($m
     */
    protected $players;
    
    protected $maxPlayers;
    
    /**
     * Construct
     * @param integer $maxPlayers
     */
    public function __construct($maxPlayers = 4)
    {
        $this->maxPlayers = $maxPlayers;
        $this->_players = new \SplFixedArray($maxPlayers);
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
}
