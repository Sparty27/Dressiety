<?php

namespace Database\Seeders;

use App\Models\SmsTemplate;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmsTemplate::firstOrCreate(
            ['name' => 'Ordered'],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => 'Ordered', 'text' => 'Hello {userName}! Thank you for ordering.']
        );
    }
}
