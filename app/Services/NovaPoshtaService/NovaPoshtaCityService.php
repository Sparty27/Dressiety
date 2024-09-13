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
    public function update(int $page, int $limit)
    {
        $cities = $this->get($page, $limit);

        if(!empty($cities))
        {
            $this->set($cities);
        }

    }

    private function get(int $page, int $limit)
    {
        try {
            $response = Http::retry(3,1000)->timeout(60)->post('https://api.novaposhta.ua/v2.0/json/',[
                'modelName' => 'Address',
                'calledMethod' => 'getCities',
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

        } catch(Exception $e) {
            Log::error($e->getMessage());
        }

        return false;
    }

    private function set($cities)
    {
        try {
            foreach($cities as $city)
            {
                City::updateOrCreate(
                    [
                        'ref' => $city['Ref'],
                    ],
                    [
                        'name' => $city['Description'],
                        'area_ref' => $city['Area'],
                    ]
                );
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
