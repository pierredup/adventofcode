<?php

function getValidTriangles(string $input): ?int
{
    $valid = 0;

    foreach (explode("\n", $input) as $line) {
        if (preg_match('/^\s+(?<one>[0-9]+)\s+(?<two>[0-9]+)\s+(?<three>[0-9]+)\n?$/', $line, $matches)) {
            if (
                ((int) $matches['one'] + (int) $matches['two']) > (int) $matches['three'] &&
                ((int) $matches['three'] + (int) $matches['one']) > (int) $matches['two'] &&
                ((int) $matches['two'] + (int) $matches['three']) > (int) $matches['one']
            ) {
                $valid++;
            }
        }
    }

    return $valid;
}

echo getValidTriangles(file_get_contents(__DIR__.'/input.txt')).PHP_EOL;