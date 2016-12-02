<?php

class Keypad {
    public $x = 1;
    public $y = 1;

    public $blocks = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9]
    ];

    public function moveUp()
    {
        if ($this->y > 0) {
            $this->y--;
        }
    }

    public function moveDown()
    {
        if ($this->y < 2) {
            $this->y++;
        }
    }

    public function moveLeft()
    {
        if ($this->x > 0) {
            $this->x--;
        }
    }

    public function moveRight()
    {
        if ($this->x < 2) {
            $this->x++;
        }
    }

    public function getCurrentPosition()
    {
        return $this->blocks[$this->y][$this->x];
    }
}

function getCode(string $input): string
{
    $lines = explode("\n", $input);

    $code = '';

    $keypad = new Keypad();

    foreach ($lines as $line) {
        foreach (str_split($line) as $position) {
            switch (strtoupper($position)) {
                case 'U':
                    $keypad->moveUp();
                    break;
                case 'D':
                    $keypad->moveDown();
                    break;
                case 'L':
                    $keypad->moveLeft();
                    break;
                case 'R':
                    $keypad->moveRight();
                    break;
            }
        }

        $code .= (string) $keypad->getCurrentPosition();
    }

    return $code;
}

echo getCode(file_get_contents(__DIR__.'/input.txt')).PHP_EOL;