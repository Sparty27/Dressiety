<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            DB::statement('ALTER TABLE products CHANGE COLUMN status available TINYINT(1)');
            $table->after('price', function(Blueprint $table) {
                $table->string('currency')->nullable();
                $table->string('vendor_code')->nullable();
            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            DB::statement('ALTER TABLE products CHANGE COLUMN available status TINYINT(1)');
            $table->dropColumn('currency');
            $table->dropColumn('vendor_code');
        });
    }
};
