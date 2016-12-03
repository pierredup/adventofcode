<?php

class Triangle
{
    private $sides = [];

    public function add(int $length): Triangle
    {
        $this->sides[] = $length;

        return $this;
    }

    public function calculate(): bool
    {
        if (3 === count($this->sides)) {
            $sides = $this->sides;
            $this->sides = [];

            return (
                ($sides[0] + $sides[1]) > $sides[2] &&
                ($sides[1] + $sides[2]) > $sides[0] &&
                ($sides[2] + $sides[0]) > $sides[1]
            );
        }

        return false;
    }
}

function getValidTriangles(string $input): ?int
{
    $col1 = new Triangle();
    $col2 = new Triangle();
    $col3 = new Triangle();

    $valid = 0;

    foreach (explode("\n", $input) as $line) {
        if (preg_match('/^\s+(?<one>[0-9]+)\s+(?<two>[0-9]+)\s+(?<three>[0-9]+)\n?$/', $line, $matches)) {
            if ($col1->add((int) $matches['one'])->calculate()) {
                $valid++;
            }

            if ($col2->add((int) $matches['two'])->calculate()) {
                $valid++;
            }

            if ($col3->add((int) $matches['three'])->calculate()) {
                $valid++;
            }
        }
    }

    return $valid;
}

echo getValidTriangles(file_get_contents(__DIR__.'/input.txt')).PHP_EOL;