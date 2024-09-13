<?php

namespace App\Services\NovaPoshtaService;

use Exception;
use App\Models\Warehouse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class   NovaPoshtaWarehouseService
{
    public function update(int $page, int $limit)
    {
        $warehouses = $this->get($page, $limit);

        if(!empty($warehouses))
        {
            $this->set($warehouses);
        }
    }

    private function get(int $page, int $limit)
    {
        $response = Http::post('https://api.novaposhta.ua/v2.0/json/',[
            'modelName' => 'Address',
            'calledMethod' => 'getWarehouses',
            'methodProperties' => [
                'Page' => $page,
                'Limit' => $limit
            ]
        ]);

        $jsonData = $response->json();

        if ($jsonData['success'] === false)
        {
            throw new Exception(implode(',', $jsonData['warnings']));
        }

        if (empty($jsonData['data']))
        {
            return false;
        }

        return $jsonData['data'];
    }

    private function set($warehouses)
    {
        try {
            foreach($warehouses as $warehouse)
            {
                Warehouse::updateOrCreate(
                    [
                        'ref' => $warehouse['Ref'],
                    ],
                    [
                        'name' => $warehouse['Description'],
                        'city_ref' => $warehouse['CityRef'],
                        'updated_at' => Carbon::now()
                    ]
                );
            }
        } catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }
}
