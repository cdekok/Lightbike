<?php
namespace Lightbike;

class Player
{
    protected $connection;
        
    public function __construct(\React\Socket\ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
}