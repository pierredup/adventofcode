<?php

class Keypad {
    public $x = 0;
    public $y = 2;

    public $blocks = [
        [null, null, 1, null, null],
        [null, 2, 3, 4, null],
        [5, 6, 7, 8, 9],
        [null, 'A', 'B', 'C', null],
        [null, null, 'D', null, null]
    ];

    public function moveUp()
    {
        if (isset($this->blocks[$this->y - 1]) && isset($this->blocks[$this->y - 1][$this->x])) {
            $this->y--;
        }
    }

    public function moveDown()
    {
        if (isset($this->blocks[$this->y + 1]) && isset($this->blocks[$this->y + 1][$this->x])) {
            $this->y++;
        }
    }

    public function moveLeft()
    {
        if (isset($this->blocks[$this->y][$this->x - 1])) {
            $this->x--;
        }
    }

    public function moveRight()
    {
        if (isset($this->blocks[$this->y][$this->x + 1])) {
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