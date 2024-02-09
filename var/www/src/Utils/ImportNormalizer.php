<?php

namespace App\Utils;


final class ImportNormalizer
{
    public static function generateModificationCode(array $params): string
    {
        return str_replace(' ', '', sprintf(
            '%s-%s-%s.%s.%s.%s.%s',
            substr($params['model']['title'], 0, 6),
            substr(md5($params['model']['title']), 0, 6),
            $params['gearbox'], $params['fuel'], $params['engine_size'], $params['power'], $params['origin_country']
        ));
    }
    
    public static function normalizeEnum(string $fieldName, ?string $value): string
    {
        if ($value === null) {
            return 'n/a';
        }
        
        $val = mb_strtolower($value);
        
        static $map = [
            'modification_gearbox' => [
                'механическая' => 'manual',
                'автоматическая' => 'auto',
                'manual gearbox' => 'manual',
            ],
            'modification_origin_country' => [
                '' => 'n/a'
            ],
            'modification_fuel' => [
                'дизель' => 'diesel',
                'бензин' => 'petrol',
                
                'электро' => 'electric',
                'elektriciteit' => 'electric',
                'electriciteit' => 'electric',
                'bev elektrisch' => 'electric',
                
                'petrol + elect' => 'h-petrol',
                'petrol + elect. rechargeable' => 'h-petrol',
                'гибрид (бензин / электрический)' => 'h-petrol',
                
                'гибрид (дизель / электрический)' => 'h-diesel',
            ],
        ];
        
        return $map[$fieldName][$val] ?? $val;
    }
    
    public static function convertValue(string $fieldName, ?string $value): ?string
    {
        if ($value === null) {
            return null;
        }
        
        $val = mb_strtolower($value);
        
        $map = [
            'modification_power' => static function (string $v): string {
                if (preg_match('/(?<hp>\d+)\s*hp/', $v, $match)) {
                    return (int)$match['hp'];
                }
                if (preg_match('/(?<kw>\d+)\s*kw/', $v, $match)) {
                    return (int)((int)$match['kw'] / 0.7456);
                }
                return 0;
            },
            'car_ad_mileage' => static function (string $v): string {
                return (int)str_replace(' ', '', $v);
            },
            'car_ad_registered_at' => static function (string $v): ?string {
                if (preg_match('/(?<dd>\d{2})\/(?<yyyy>\d{4})/', $v, $match)) {
                    return sprintf('%s-%s-01', $match['yyyy'], $match['dd']);
                }
                return null;
            },
        ];
        
        return is_callable($map[$fieldName]) ? $map[$fieldName]($val) : $val;
    }
}
