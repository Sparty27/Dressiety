<?php

namespace App\Services\MyDropServices;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
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
            ]
        ]);

        $xmlString = $res->getBody()->getContents();

        $filePath = 'xml/products.xml';

        Storage::put($filePath, $xmlString);
    }

    public function parse()
    {
        $relativePath = 'app/xml/products.xml';

        $fullPath = storage_path($relativePath);

        $xml = simplexml_load_file($fullPath);


//        $xml = XmlParser::load($fullPath);
//
//        $categories = $xml->parse([
//           'categories' => ['uses' => 'shop.categories']
//        ]);

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
            $product = Product::updateOrCreate([
                'product_id' => (string)$offer['id']
            ], [
                'category_id' => (int)$offer->categoryId,
                'name' => (string)$offer->name,
                'description' => (string)$offer->description,
                'currency' => (string)$offer->currencyId,
                'count' => (int)$offer->quantity_in_stock,
                'vendor_code' => (string)$offer->vendorCode,
                'available' => (bool)$offer->available,
                'price' => ((int)$offer->price * 100)
            ]);
        }
    }
}
