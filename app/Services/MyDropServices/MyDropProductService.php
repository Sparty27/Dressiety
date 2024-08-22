<?php

namespace App\Services\MyDropServices;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

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

    public function loadProductData()
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

    public function getProductData()
    {
        $this->loadProductData();

        $fullPath = storage_path('app/xml/products.xml');

        return simplexml_load_file($fullPath);
    }

    public function parse()
    {
        $xml = $this->getProductData();

        $this->updateCategories($xml);

        $this->updateProducts($xml);

        $this->updateProductPhotos($xml);
    }

    function updateCategories($xml)
    {
        foreach($xml->shop->categories->category as $category)
        {
            $parentId = (int)$category['parentId'] ? (int)$category['parentId'] : null;

            Category::updateOrCreate([
                'category_id' => (int)$category['id'],
            ], [
                'name' => (string)$category,
                'parent_id' => $parentId
            ]);
        }
    }

    function updateProducts($xml)
    {
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

                $product->clothing()->updateOrCreate([
                    'product_id' => $product->id,
                    'group_id' => $product->group_id,
                ],[
                    'size' => $params['Размер'] ?? null,
                    'color' => $params['Колір'] ?? null,
                    'material' => $params['Матеріал'] ?? null,

                ]);
            } catch(Exception $ex) {
                Log::error($ex->getMessage());
            }
        }
    }

    function updateProductPhotos($xml)
    {
        foreach($xml->shop->offers->offer as $offer)
        {
            Log::channel('daily')->info('Updating product with id - '.$offer['id']);

            try {
                $product = Product::where('product_id', (string)$offer['id'])->first();

                for($i = 0; $i < count($offer->picture); $i++)
                {
                    Log::channel('daily')->info('Image with id - '. $offer['id']. '. Current product photo iteration - '.($i + 1));

                    $url = (string)$offer->picture[$i];

                    $newUrl = $this->saveImage($url);

                    if(!$newUrl)
                        continue;

                    $product->photos()->updateOrCreate([
                        'url' => $newUrl
                    ],[
                        'priority' => ($i + 1)
                    ]);
                }
            } catch(Exception $ex) {
                Log::error($ex->getMessage());
            }
        }
    }

    function saveImage($url)
    {
        $tempFileName = 'temp_' . pathinfo($url, PATHINFO_BASENAME);
        $tempFilePath = 'public/temp/' . $tempFileName;
        $finalFilePath = 'public/products/' . pathinfo($url, PATHINFO_BASENAME);

        if (Storage::exists($finalFilePath)) {
            return Storage::url($finalFilePath);
        }

        try {
            $response = Http::get($url);

            if ($response->failed()) {
                return false;
            }

            $contents = $response->body();

        } catch (\Exception $ex) {
            Log::error('Failed to download image: ' . $ex->getMessage());
            return false;
        }

        if (Storage::put($tempFilePath, $contents)) {
            Storage::move($tempFilePath, $finalFilePath);

            return Storage::url($finalFilePath);
        }

        return false;
    }
}
