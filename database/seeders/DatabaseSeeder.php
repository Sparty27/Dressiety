<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Middleware\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Category::factory(10)->create();

//        Product::factory(30)->create();

//        Tag::factory(10)->create();
//
//        $this->call([
//            SeoTemplateSeeder::class,
//        ]);
//
//        $this->call([
//            EmailTemplateSeeder::class,
//        ]);
//
//        $this->call([
//            SmsTemplateSeeder::class,
//        ]);

        $this->call([
            AdminSeeder::class,
        ]);
    }
}
