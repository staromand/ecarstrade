<?php

namespace App\Strategy\Report;

class DistinctGearbox extends DistinctField
{
    protected function getFieldName(): string
    {
        return 'gearbox';
    }
}
