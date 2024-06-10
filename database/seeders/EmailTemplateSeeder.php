<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailTemplate::firstOrCreate(
            ['name' => 'Ordered'],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'subject' => 'Ordered', 'body' => 'Ordered']
        );

        EmailTemplate::firstOrCreate(
            ['name' => 'Shipping'],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'subject' => 'Shipped', 'body' => 'Shipped']
        );

        EmailTemplate::firstOrCreate(
            ['name' => 'Password Reset'],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'subject' => 'Reset Password', 'body' => 'Reset Password']
        );
    }
}
