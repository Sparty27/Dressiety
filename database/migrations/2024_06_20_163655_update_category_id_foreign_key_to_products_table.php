<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        Schema::table('products', function (Blueprint $table) {
////            $table->foreign('category_id')->references('id')->on('categories')->onDelete('Cascade');
//
//
//            $table->dropForeign(['category_id']);
//            $table->dropColumn('category_id');
//
//            $table->integer('category_id')->nullable();
//            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('Cascade');
//        });

//        Schema::table('products', function (Blueprint $table) {
//            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('Cascade');
//        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);

            $table->dropColumn('category_id');
        });

        Schema::table('products', function (Blueprint $table) {
            // Додавання нової колонки
            $table->integer('category_id')->nullable();
            // Додавання зовнішнього ключа
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('Cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('products', function (Blueprint $table) {
////            $table->dropForeign(['category_id']);
////            $table->dropColumn('category_id');
//
////            $table->foreign('category_id')->references('id')->on('categories');
//        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);

            $table->dropColumn('category_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });
    }
};
