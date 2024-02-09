<?php

namespace App\Strategy\Report;

use App\Utils\Console;

class AvgMileage implements StrategyInterface
{
    
    public function report(\PDO $pdo): void
    {
        $q = '
            select avg(mileage) as mileage from car_ad where mileage > 0;
        ';
    
        $result = $pdo->query($q)->fetch();
        
        Console::writeOut(sprintf('Average Mileage: %.2f', $result['mileage']));
    }
}
