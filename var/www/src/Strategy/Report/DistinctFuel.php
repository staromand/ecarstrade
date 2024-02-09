<?php

namespace App\Strategy\Report;

class DistinctFuel extends DistinctField
{
    protected function getFieldName(): string
    {
        return 'fuel';
    }
}
