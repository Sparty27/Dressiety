<?php

namespace App\Services\NovaPoshtaService;

use App\Models\Area;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NovaPoshtaAreaService
{
    public function get()
    {
        $response = Http::post('https://api.novaposhta.ua/v2.0/json/',
        [
            'modelName' => 'Address',
            'calledMethod' => 'getAreas',
            'methodProperties' => [
            'Page' => 1,
            'Limit' => 100
            ]
        ]);

        $response = $response->json();

        if ($response['success'] === false)
        {
            throw new Exception(implode(',', $response['warnings']));
        }

        return $response['data'];
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
