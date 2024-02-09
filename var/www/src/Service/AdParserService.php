<?php

namespace App\Service;


final class AdParserService
{
    private static array $PATTERNS = [
        'car_ad_id' => '/data-itemId="(?<car_ad_id>[^"]+)"/su',
        'car_ad_title' => '/<a\s[^>]+>[^<]*<span>(?<car_ad_title>[^<]+)<\/span>/su',
        'car_ad_registered_at' => '/<i class="fas fa-calendar-alt"><\/i>.*?(?<car_ad_registered_at>\d{2}\/\d{4})[^<]*<\/span>/su',
        'car_ad_mileage' => '/<i class="fas fa-tachometer-alt"><\/i>.*?(?<car_ad_mileage>[\d\s]+)[^<]*<\/span>/su',
        
        'model_title' => '/<div class="small text-muted">\s*\#[\d]+\s-\s(?<model_title>[^<]+)<\/div>/su',
        
        'modification_gearbox' => '/<i class="fas fa-cog"><\/i>\s*(?<modification_gearbox>[^<]+?)\s*<\/span>/su',
        'modification_fuel' => '/<i class="fas fa-gas-pump"><\/i>\s*(?<modification_fuel>[^<]+?)\s*<\/span>/su',
        'modification_engine_size' => '/<span class="item_engine"><\/span>\s*(?<modification_engine_size>\d+)[^<]*<\/span>/su',
        'modification_origin_country' => '/<div class="item-action icon-country-origin"[^s]*style="background-image: url\(\'\/images\/flags\/h40\/(?<modification_origin_country>[^\.]+)\.[^\']+\'\)"/su',
        'modification_power' => '/<i class="fas fa-bolt"><\/i>\s*(?<modification_power>[^<]+?)\s*<\/span>/su',
        'modification_emission_class' => '/<i class="fas fa-cloud"><\/i>\s*(?<modification_emission_class>[^<]+?)\s*<\/span>/su',
        'modification_co2_value' => '/<i class="fas fa-wind"><\/i>\s*(?<modification_co2_value>\d+)\sCO<sub>2/su',
    ];
    
    public function __construct()
    {
    
    }
    
    public function parse(string $html): array
    {
        $data = [];
        foreach (self::$PATTERNS as $fieldName => $pattern) {
            $data[$fieldName] = null;
            
            if (preg_match($pattern, $html, $matches)) {
                $data[$fieldName] = trim($matches[$fieldName]);
            }
        }
        
        return $data;
    }
}
