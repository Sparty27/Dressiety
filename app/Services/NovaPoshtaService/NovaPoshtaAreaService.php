<?php

namespace App\Services\NovaPoshtaService;

use App\Models\Area;
use Cloudipsp\Api\Order\Status;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class NovaPoshtaAreaService
{
    public function get()
    {
        try {
            $response = Http::post('https://api.novaposhta.ua/v2.0/json/',
                [
                    'modelName' => 'Address',
                    'calledMethod' => 'getAreas',
                    'methodProperties' => [
                        'Page' => 1,
                        'Limit' => 100
                    ]
                ]);

            $jsonData = $response->json();

            if ($jsonData['success'] === false)
            {
                throw new Exception(implode(',', $jsonData['warnings']));
            }

            return $jsonData['data'];

        } catch(Exception $e) {
            Log::error($e->getMessage());
        }

        return false;
    }

    public function set($areas)
    {
        foreach ($areas as $area)
        {
            Area::updateOrCreate(
                [
                    'ref' => $area['Ref'],
                ],
                [
                    'name' => $area['Description'],
                ]
            );
        }
    }

    public function update()
    {
        try
        {
            $areas = $this->get();

            $this->set($areas);

        } catch (Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
}
