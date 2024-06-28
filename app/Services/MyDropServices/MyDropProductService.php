<?php

namespace App\Services\MyDropServices;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Orchestra\Parser\Xml\Facade as XmlParser;

class MyDropProductService
{
    private $apiKey;
    private $client;

    public function __construct()
    {
        $this->apiKey = config('mydrop.api_key');

        $this->client = new Client([
            'base_uri' => config('mydrop.domain'),
        ]);
    }

    public function get()
    {
        $res = $this->client->get('/vendor/api/export/products/prom/yml',
        [
            'query' => [
                'public_api_key' => $this->apiKey,
                'stock_sync' => 'true',
                'price_field' => 'drop_price',
                'param_name' => 'Размер'
            ]
        ]);

        $xmlString = $res->getBody()->getContents();

        Storage::put('xml/products.xml', $xmlString);
    }

    public function parse()
    {
        $fullPath = storage_path('app/xml/products.xml');

        $xml = simplexml_load_file($fullPath);

        foreach($xml->shop->categories->category as $category)
        {
            $parentId = (int)$category['parentId'] ? (int)$category['parentId'] : null;

            Category::updateOrCreate([
                'category_id' => (integer)$category['id'],
            ], [
                'name' => (string)$category,
                'parent_id' => $parentId
            ]);
        }

        foreach($xml->shop->offers->offer as $offer)
        {
            try {
                $params = [];
                foreach ($offer->param as $param) {
                    $name = (string) $param['name'];
                    $value = (string) $param;
                    $params[$name] = $value;
                }

                $product = Product::updateOrCreate([
                    'product_id' => (string)$offer['id']
                ], [
                    'group_id' => (string) $offer['group_id'] === '' ? null : (string) $offer['group_id'],
                    'category_id' => (int)$offer->categoryId,
                    'name' => (string)$offer->name,
                    'description' => (string)$offer->description,
                    'currency' => (string)$offer->currencyId,
                    'count' => (int)$offer->quantity_in_stock,
                    'vendor_code' => (string)$offer->vendorCode,
                    'available' => (bool)$offer->available,
                    'price' => ((int)$offer->price * 100)
                ]);

//                for($i = 0; $i < count($offer->picture);$i++)
//                {
//                    $url = (string)$offer->picture[$i];
//
//                    $newUrl = $this->saveImage($url);
//
//                    $product->photos()->updateOrCreate([
//                        'url' => $newUrl
//                    ],[
//                        'priority' => ($i + 1)
//                    ]);
//
//                    Log::channel('daily')->info('image '.($i + 1));
//                }

                $product->clothing()->updateOrCreate([
                    'product_id' => $product->id
                ],[
                    'size' => $params['Размер'] ?? null,
                    'color' => $params['Колір'] ?? null,
                    'material' => $params['Матеріал'] ?? null,
                ]);

                Log::channel('daily')->info((string)$offer['id']);

            } catch(Exception $ex) {
                Log::channel('daily')->error($ex->getMessage());
            }
        }

        foreach($xml->shop->offers->offer as $offer)
        {
            Log::channel('daily')->info('Offer: '.$offer['id']);

            try {
                $product = Product::where('product_id', (string)$offer['id'])->first();

                for($i = 0; $i < count($offer->picture);$i++)
                {
                    Log::channel('daily')->info($offer['id'].' image '.($i + 1));

                    $url = (string)$offer->picture[$i];

                    $newUrl = $this->saveImage($url);

                    if($newUrl == '')
                        continue;

                    $product->photos()->updateOrCreate([
                        'url' => $newUrl
                    ],[
                        'priority' => ($i + 1)
                    ]);
                }
            } catch(Exception $ex) {
                Log::channel('daily')->error($ex->getMessage());
            }
        }
    }

    public function saveImageForced($url)
    {
        Log::channel('daily')->info('Method saveImageForced url: '.$url);

        $fileName = pathinfo($url, PATHINFO_BASENAME);

        $filePath = 'public/products/'.$fileName;

        $response = Http::get($url);

        if($response->status() == 200)
        {
            Log::channel('daily')->info('Method file_get_contents url: '.$url);
            $contents = file_get_contents($url);
        } else {
            return '';
        }

        if(Storage::put($filePath, $contents))
        {
            return Storage::url($filePath);
        }

        return '';
    }

    private function saveImage($url)
    {
        $fileName = pathinfo($url, PATHINFO_BASENAME);

        $filePath = 'public/products/'.$fileName;

        Log::channel('daily')->info('Save image url: '.$url);

        if(Storage::exists($filePath))
            return Storage::url($filePath);

        try {
            $response = Http::get($url);

            if($response->status() != 200)
                return '';

            Log::channel('daily')->info('entered to method file_get_contents url: '.$url);
            $contents = file_get_contents($url);

        } catch(Exception $ex) {
            throw new \Exception('aboba');
        }

        if(!isset($contents))
            return '';

        if(Storage::put($filePath, $contents))
            return Storage::url($filePath);
    }

    public function test()
    {
        $url = 'https://backend.mydrop.com.ua/vendor/products/uploads/4be670d00209876e20e4.jpeg';

        $response = Http::get($url);

        dd($response->status() == 200);
    }
}
