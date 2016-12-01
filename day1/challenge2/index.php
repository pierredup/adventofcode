<?php

const NORTH = 1;
const EAST = 2;
const SOUTH = 4;
const WEST = 8;

class Position implements Serializable
{
    public $north = 0;
    public $east = 0;
    public $south = 0;
    public $west = 0;

    public $location;

    public $currentDirection = NORTH;

    private $visited = [];

    public function move($direction, $blocksToMove, $incr, $decr)
    {
        $this->currentDirection = $direction;

        for ($i = 1; $i <= $blocksToMove; $i++) {
            $this->{$incr}++;
            $this->{$decr}--;

            $currenPosition = serialize($this);

            if (in_array($currenPosition, $this->visited)) {
                $this->location = abs($this->north + $this->east);
                break;
            }

            $this->visited[] = $currenPosition;
        }
    }

    public function serialize(): string
    {
        return serialize([$this->north, $this->east, $this->south, $this->west]);
    }

    public function unserialize($serialized)
    {
        list($this->north, $this->east, $this->south, $this->west) = $this->unserialize($serialized);
    }
}

function getBlocks(string $input): string
{
    $directions = array_map('trim', explode(',', $input));

    $position = new Position();

    foreach ($directions as $direction) {
        $blocksToMove = (int) substr($direction, 1);

        switch (strtoupper(substr($direction, 0, 1))) {
            case 'R':
                switch ($position->currentDirection) {
                    case NORTH:
                        $position->move(EAST, $blocksToMove, 'east', 'west');
                        break;
                    case EAST:
                        $position->move(SOUTH, $blocksToMove, 'south', 'north');
                        break;
                    case SOUTH:
                        $position->move(WEST, $blocksToMove, 'west', 'east');
                        break;
                    case WEST:
                        $position->move(NORTH, $blocksToMove, 'north', 'south');
                        break;
                }
                break;

            case 'L':
                switch ($position->currentDirection) {
                    case NORTH:
                        $position->move(WEST, $blocksToMove, 'west', 'east');
                        break;
                    case EAST:
                        $position->move(NORTH, $blocksToMove, 'north', 'south');
                        break;
                    case SOUTH:
                        $position->move(EAST, $blocksToMove, 'east', 'west');
                        break;
                    case WEST:
                        $position->move(SOUTH, $blocksToMove, 'south', 'north');
                        break;
                }
                break;
        }

        if ($position->location) {
            return $position->location;
        }
    }

    return abs($position->north + $position->east);
}

echo getBlocks(file_get_contents(__DIR__.'/input.txt')).PHP_EOL;