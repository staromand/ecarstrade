<?php

namespace App\Strategy\Report;

interface StrategyInterface
{
    public function report(\PDO $pdo): void;
}
