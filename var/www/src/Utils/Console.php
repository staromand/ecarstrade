<?php

namespace App\Utils;


final class Console
{
    public static function writeOut(string $msg): void
    {
        echo '> ' . $msg . PHP_EOL;
    }
    
    public static function writeTable(array $array): void
    {
        $mask = "|%-25.25s |%10.10s |\n";
        foreach ($array as $key => $value) {
            printf($mask, $key, $value);
        }
        
        echo PHP_EOL;
    }
}
