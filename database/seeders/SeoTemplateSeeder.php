<?php

namespace Database\Seeders;

use App\Models\SeoTemplate;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoTemplate::firstOrCreate(
            ['seoble_type' => 'products'],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'title' => 'test template', 'description' => 'test description']
        );

        SeoTemplate::firstOrCreate(
            ['seoble_type' => 'pages'],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'title' => 'another test template', 'description' => 'another test description']
        );
    }
}
