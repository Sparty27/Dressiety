<?php

namespace App\Services\NovaPoshtaService;

use Exception;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NovaPoshtaWarehouseService
{
    public function get($page)
    {
        $response = Http::post('https://api.novaposhta.ua/v2.0/json/',[
            'modelName' => 'Address',
            'calledMethod' => 'getWarehouses',
            'methodProperties' => [
                'Page' => $page,
                'Limit' => 300
            ]
        ]);

        $response = $response->json();

        if ($response['success'] === false)
        {
            throw new Exception(implode(',', $response['warnings']));
        }

        if (empty($response['data']))
        {
            return false;
        }

        $response = $response['data'];

        return $response;
    }

    public function set($warehouses)
    {
        foreach($warehouses as $warehouse)
        {
            try {
                Warehouse::updateOrCreate(
                    [
                        'ref' => $warehouse['Ref'],
                    ],
                    [
                        'name' => $warehouse['Description'],
                        'city_ref' => $warehouse['CityRef'],
                    ]
                );
            } catch (Exception $ex){
                Log::error($ex->getMessage());
            }

        }
    }

    public function update()
    {
        try
        {
            $page = 1;
            while(true)
            {
                $warehouses = $this->get($page);

                if ($warehouses === false) break;

                $this->set($warehouses);

                $page++;
            }

        } catch (Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
}
