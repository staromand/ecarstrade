<?php

namespace App\Strategy\Report;

use App\Utils\Console;

class Top3Countries implements StrategyInterface
{
    
    public function report(\PDO $pdo): void
    {
        $q = '
            select count(*) as cnt, UPPER(m.origin_country) as country
            from car_ad a
            inner join modification m on a.modification_code = m.code
            group by m.origin_country
            ORDER BY count(*) desc
            limit 3
        ';
    
        $result = array_column($pdo->query($q)->fetchAll(), 'cnt', 'country');
        
        Console::writeOut('TOP-3 Countries of origin with counts:');
        Console::writeTable($result);
        Console::writeOut(PHP_EOL);
    }
}
