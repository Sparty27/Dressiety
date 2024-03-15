<?php

namespace App\Services\NovaPoshtaService;

use Illuminate\Support\Facades\Http;

class Service
{
    public function getCities()
    {
        $response = Http::post('https://api.novaposhta.ua/v2.0/json/',[
            'modelName' => 'Address',
            'calledMethod' => 'getCities',
            'methodProperties' => [
                'Page' => 1,
                'Limit' => 50
            ]
        ]);

        $data = $response->json();

        return collect($data['data']);
    }
}
