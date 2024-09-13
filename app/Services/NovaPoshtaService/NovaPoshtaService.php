<?php

namespace App\Services\NovaPoshtaService;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NovaPoshtaService
{
    public const CITIES = 1;
    public const WAREHOUSES = 2;

    public static function getTotalCount($type): int
    {
        if($type == self::CITIES)
            $calledMethod = 'getCities';
        if($type == self::WAREHOUSES)
            $calledMethod = 'getWarehouses';

        if(!$calledMethod)
            return false;

        try {
            $response = Http::post('https://api.novaposhta.ua/v2.0/json/',[
                'modelName' => 'Address',
                'calledMethod' => $calledMethod,
                'methodProperties' => [
                    'Page' => 1,
                    'Limit' => 1
                ]
            ]);

            $jsonData = $response->json();

            if($jsonData['success'])
                return $jsonData['info']['totalCount'];

            return false;
        } catch(\Exception $e) {
            Log::error($e->getMessage());
        }

        return false;
    }
}
