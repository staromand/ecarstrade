<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;

final class CarFetcherService
{
    private static int $PER_PAGE = 100;
    
    private ClientInterface $client;
    
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://ru.ecarstrade.com',
        ]);
        
    }
    
    private static function getDefaultQuery(): array
    {
        return [
            'request_type' => 'cars',
            'auction_type' => ['stock', 'bid', 'open', 'fix', 'bid_or_fix'],
            'sort' => 'mark_model.asc',
            'vat' => 'any',
            'power_value' => 'kw',
            'perpage' => self::$PER_PAGE,
        ];
    }
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCars(int $page): array
    {
        $response = $this->client->request('GET', 'future_api.php', [
            RequestOptions::QUERY => array_merge(self::getDefaultQuery(), [
                'start' => ($page - 1) * self::$PER_PAGE
            ])
        ]);
        
        $data = [];
        $strJson = str_replace('}{', '},{', $response->getBody());
        try {
            $decoded = json_decode('[' . $strJson . ']' , true, 512, JSON_THROW_ON_ERROR);
            
            foreach ($decoded as $item) {
                if (!isset($item['car_id'])) {
                    continue;
                }
    
                $data[$item['car_id']] = $item;
            }
        } catch (\Throwable) {
            return [];
        }
       
        return $data;
    }
}
