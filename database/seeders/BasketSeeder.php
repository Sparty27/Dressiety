<?php

namespace Database\Seeders;

use App\Models\BasketProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BasketProduct::factory(5)->create();
    }
}
