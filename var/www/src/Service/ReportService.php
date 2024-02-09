<?php

namespace App\Service;


use App\Strategy\Report\StrategyInterface;

final class ReportService
{
    public function __construct(
        private \PDO $pdo
    )
    {}
    
    public function runReports(StrategyInterface ...$reportStrategyList): void
    {
        foreach ($reportStrategyList as $strategy) {
            $strategy->report($this->pdo);
            echo PHP_EOL;
        }
    }
}
