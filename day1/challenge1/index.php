<?php

const NORTH = 1;
const EAST = 2;
const SOUTH = 4;
const WEST = 8;

class Position
{
    public $north = 0;

    public $east = 0;

    public $currentDirection = NORTH;
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
                        $position->currentDirection = EAST;
                        $position->east += $blocksToMove;
                        break;
                    case EAST:
                        $position->currentDirection = SOUTH;
                        $position->north -= $blocksToMove;
                        break;
                    case SOUTH:
                        $position->currentDirection = WEST;
                        $position->east -= $blocksToMove;
                        break;
                    case WEST:
                        $position->currentDirection = NORTH;
                        $position->north += $blocksToMove;
                        break;
                }
                break;

            case 'L':
                switch ($position->currentDirection) {
                    case NORTH:
                        $position->currentDirection = WEST;
                        $position->east -= $blocksToMove;
                        break;
                    case EAST:
                        $position->currentDirection = NORTH;
                        $position->north += $blocksToMove;
                        break;
                    case SOUTH:
                        $position->currentDirection = EAST;
                        $position->east += $blocksToMove;
                        break;
                    case WEST:
                        $position->currentDirection = SOUTH;
                        $position->north -= $blocksToMove;
                        break;
                }
                break;
        }
    }

    return abs($position->north + $position->east);
}

echo getBlocks(file_get_contents(__DIR__.'/input.txt')).PHP_EOL;