<?php

namespace App\Strategy\Report;

use App\Utils\Console;

class MaxMinHp implements StrategyInterface
{
    
    public function report(\PDO $pdo): void
    {
        $q = '
            select max(power) as max, min(power) as min
            from modification m
            where power > 0
        ';
    
        $result = $pdo->query($q)->fetch();
    
        Console::writeOut('Maximum and minimum Power in HP:');
        Console::writeTable($result);
    }
}
