<?php

class ArrayDump
{
    public static function dump($array, $indent = 0)
    {
        foreach ($array as $key => $value) {
            echo str_repeat('  ', $indent); // Add indentation
            echo "[" . $key . "] => ";

            if (is_array($value)) {
                echo PHP_EOL;
                self::dump($value, $indent + 1); // Recursive call for nested arrays
            } else {
                echo $value . PHP_EOL;
            }
        }
    }
}
