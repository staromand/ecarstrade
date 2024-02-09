<?php

namespace App\Strategy\Report;

use App\Utils\Console;

abstract class DistinctField implements StrategyInterface
{
    protected function getReportMessage(string $value): string
    {
        return sprintf('Lists of all available options of %s: %s', $this->getFieldName(), $value);
    }
    
    abstract protected function getFieldName(): string;
    
    public function report(\PDO $pdo): void
    {
        $q = sprintf('
                select distinct %s from modification where %1$s != \'n/a\'
            ',
            $this->getFieldName()
        );
    
        $result = $pdo->query($q)->fetchAll();
        
        Console::writeOut($this->getReportMessage(
            implode(', ', array_column($result, $this->getFieldName()))
        ));
    }
}
