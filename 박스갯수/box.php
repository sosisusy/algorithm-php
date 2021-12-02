<?php

define("BOX_CAHR", "#");

function checkBox(array $buffer, int $startLine, int $startIndex)
{
    $endLine = count($buffer) - 1;
    $endIndex = count($buffer[$startLine]) - 1;

    for ($index = $startIndex; $index <= $endIndex; $index++) {
        if ($buffer[$startLine][$index] != BOX_CAHR) {
            $endIndex = $index - 1;
            break;
        }
    }

    for ($line = $startLine; $line <= $endLine; $line++) {
        if ($buffer[$line][$startIndex] != BOX_CAHR) {
            $endLine = $line - 1;
            break;
        }
    }

    if ($startLine == $endLine || $startIndex == $endIndex) return false;

    for ($index = $startIndex; $index <= $endIndex; $index++) {
        if ($buffer[$endLine][$index] != BOX_CAHR) return false;
    }

    for ($line = $startLine; $line <= $endLine; $line++) {
        if ($buffer[$line][$endIndex] != BOX_CAHR) return false;
    }

    return true;
}

function solution(string $txt)
{
    $lines = explode("\n", $txt);

    $buffer = [];
    $boxCount = 0;
    $line = 0;

    foreach ($lines as $txt) {
        $words = str_split($txt);

        foreach ($words as $i => $word) {
            $buffer[$line][$i] = $word;
        }

        $line++;
    }

    foreach ($buffer as $line => $words) {

        foreach ($words as $index => $word) {
            if ($word == BOX_CAHR && checkBox($buffer, $line, $index))
                $boxCount++;
        }
    }

    return $boxCount;
}

$result = solution(file_get_contents(__DIR__ . "/box.txt"));

echo $result . PHP_EOL;
