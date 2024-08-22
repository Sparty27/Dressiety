<?php

namespace App\Services\NovaPoshtaService;

use Exception;
use App\Models\City;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Laravel\SerializableClosure\Exceptions\PhpVersionNotSupportedException;
use SebastianBergmann\Environment\Console;

class NovaPoshtaCityService
{
    public function get($page)
    {
        $response = Http::retry(3, 1000)->timeout(60)->post('https://api.novaposhta.ua/v2.0/json/',[
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
            try {
                City::updateOrCreate(
                    [
                        'ref' => $city['Ref'],
                    ],
                    [
                        'name' => $city['Description'],
                        'area_ref' => $city['Area'],
                    ]
                );
            } catch (Exception $ex) {
                Log::error($ex->getMessage());
                Log::channel('daily')->error($ex->getMessage());
            }
        }
    }

    public function update()
    {
        $page = 1;
        while(true)
        {
            try
            {
                $cities = $this->get($page);
            } catch (Exception $e)
            {
                Log::error($e->getMessage());
                Log::channel('daily')->error($e->getMessage());

                $page++;
                continue;
            }

            if ($cities === false)
                break;

            $this->set($cities);

            $page++;
        }
    }
}
