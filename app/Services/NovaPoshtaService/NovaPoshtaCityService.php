<?php

namespace App\Services\NovaPoshtaService;

use Exception;
use App\Models\City;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NovaPoshtaCityService
{
    public function get($page)
    {
        $response = Http::post('https://api.novaposhta.ua/v2.0/json/',[
            'modelName' => 'Address',
            'calledMethod' => 'getCities',
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

    public function set($cities)
    {
        foreach($cities as $city)
        {
            City::updateOrCreate(
                [
                    'ref' => $city['Ref'],
                ],
                [
                    'name' => $city['Description'],
                ]
            );
        }
    }

    public function update()
    {
        try
        {
            $page = 1;
            while(true)
            {
                $cities = $this->get($page);

                if ($cities === false) break;

                $this->set($cities);

                $page++;
            }
            
        } catch (Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
}